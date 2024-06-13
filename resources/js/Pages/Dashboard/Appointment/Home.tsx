import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import DashboardLayout from "@/Layouts/Dashboard"
import Alert from "@/Components/Alert"
import Pagination from "@/Components/Pagination"

import { PageProps } from "@/types"

export default function AppointmentList() {
  const { auth, appointments, status } = usePage<PageProps>().props

  const { setData, get } = useForm({
    search: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    get(route("appointment.manage"))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD/MM/YYYY HH:mm")
  }
  return (
    <DashboardLayout>
      <Head title="Appointment List" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Appointment List</div>
        <Alert message={status} />
        <div className="mb-3 flex items-center justify-between">
          <Link
            href={route("appointment.home")}
            className="h-full w-fit rounded bg-[#800080] px-2 py-1 text-sm font-semibold text-white"
          >
            Buat Janji Temu
          </Link>
          <form
            className="flex h-fit w-full max-w-60 items-center gap-x-2.5 rounded-full border-2 border-gray-300 px-3 text-sm"
            onSubmit={submit}
          >
            <input
              className="w-full border-none bg-transparent px-0 py-1 text-sm text-gray-700 outline-none focus:ring-0"
              placeholder="Search"
              type="text"
              onChange={(e) => setData("search", e.target.value)}
            />
            <button type="submit">
              <i className="ri-search-line text-sm text-gray-500"></i>
            </button>
          </form>
        </div>
        <table className="w-full table-auto border-collapse rounded border">
          <thead>
            <tr>
              <th className="border px-2 py-1.5 text-center">No</th>
              {auth.user.service == "none" ? (
                <th className="border px-2 py-1.5 text-left">Spesialist</th>
              ) : (
                <th className="border px-2 py-1.5 text-left">Pemesan</th>
              )}
              <th className="border px-2 py-1.5 text-left">Layanan</th>
              <th className="border px-2 py-1.5 text-left">Waktu</th>
              <th className="border px-2 py-1.5 text-left" colSpan={2}>
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            {appointments.data.length > 0 ? (
              appointments.data.map((v, i) => (
                <tr key={i.toString()}>
                  <td className="text-center">{i + appointments.from}</td>
                  <td className="border px-2 py-1.5">
                    <div className="flex flex-row items-center gap-x-2 font-medium">
                      <img
                        src={`${auth.user.service == "none" ? v.specialist_avatar : v.requester_avatar}?s=32&d=wavatar&r=pg`}
                        className="h-7 rounded-full"
                      />
                      <span>
                        {auth.user.service == "none"
                          ? v.specialist_name
                          : v.requester_name}
                      </span>
                    </div>
                  </td>
                  <td className="border px-2 py-1.5">{v.service}</td>
                  <td className="px-2 py-1.5">{formatDate(v.time)}</td>
                  <td className="px-2 py-1.5">
                    <div
                      className={`${
                        v.status == "requested"
                          ? "bg-yellow-500"
                          : v.status == "rejected"
                            ? "bg-red-500"
                            : v.status == "accepted"
                              ? "bg-blue-600"
                              : "bg-green-600"
                      } w-fit rounded px-1.5 py-0.5 text-sm text-white`}
                    >
                      {v.status}
                    </div>
                  </td>
                  <td className="px-2 py-1.5">
                    <div className="flex items-center gap-x-1 text-white">
                      <Link
                        href={route("appointment.view", { id: v.id })}
                        className="rounded bg-yellow-500 px-2 py-1"
                      >
                        <i className="ri-eye-line"></i>
                      </Link>
                      {auth.user.service == "none" &&
                        (v.status == "completed" && !v.completed ? (
                          <Link
                            href={route("appointment.review", { id: v.id })}
                            className="rounded bg-blue-600 px-2 py-1"
                          >
                            <i className="ri-pencil-line"></i>
                          </Link>
                        ) : (
                          <div className="cursor-not-allowed rounded bg-blue-400 px-2 py-1">
                            <i className="ri-pencil-line"></i>
                          </div>
                        ))}
                    </div>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td className="px-2 py-1.5 text-center" colSpan={5}>
                  Tidak Ada Permintaan Janji Temu!
                </td>
              </tr>
            )}
          </tbody>
        </table>
        <Pagination data={appointments} />
      </div>
    </DashboardLayout>
  )
}
