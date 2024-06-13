import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import DashboardLayout from "@/Layouts/Dashboard"
import Alert from "@/Components/Alert"
import Pagination from "@/Components/Pagination"

import { PageProps } from "@/types"

export default function UsersManage() {
  const { users, status } = usePage<PageProps>().props

  const { data, setData, get } = useForm({
    search: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    get(route("users.manage"))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD/MM/YYYY HH:mm:ss")
  }
  return (
    <DashboardLayout>
      <Head title="Manage Users" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Manage Users</div>
        <Alert message={status} />
        <div className="mb-3 flex items-center justify-end">
          <form
            className="flex h-fit w-full max-w-60 items-center gap-x-2.5 rounded-full border-2 border-gray-300 px-3 text-sm"
            onSubmit={submit}
          >
            <input
              className="w-full border-none bg-transparent px-0 py-1 text-sm text-gray-700 outline-none focus:ring-0"
              placeholder="Search"
              type="text"
              value={data.search}
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
              <th className="border px-2 py-1.5 text-left">User</th>
              <th className="border px-2 py-1.5 text-left">Service</th>
              <th className="border px-2 py-1.5 text-left" colSpan={2}>
                Register
              </th>
            </tr>
          </thead>
          <tbody>
            {users.data.length > 0 ? (
              users.data.map((v, i) => (
                <tr key={i.toString()}>
                  <td className="text-center">{i + users.from}</td>
                  <td className="border px-2 py-1.5">
                    <div className="flex flex-row items-center gap-x-2 font-medium">
                      <img
                        src={`${v.avatar}?s=32&d=wavatar&r=pg`}
                        className="h-7 w-7 rounded-full"
                      />
                      <span>{v.name}</span>
                    </div>
                  </td>
                  <td className="border px-2 py-1.5">
                    {v.service == "none" ? "-" : v.service}
                  </td>
                  <td className="px-2 py-1.5">{formatDate(v.created_at)}</td>
                  <td className="px-2 py-1.5">
                    <div className="flex items-center gap-x-1 text-white">
                      <Link
                        href={route("users.edit", { id: v.id })}
                        className="rounded bg-blue-600 px-2 py-1"
                      >
                        <i className="ri-pencil-line"></i>
                      </Link>
                    </div>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td className="px-2 py-1.5 text-center" colSpan={5}>
                  Tidak Ada User!
                </td>
              </tr>
            )}
          </tbody>
        </table>
        <Pagination data={users} />
      </div>
    </DashboardLayout>
  )
}
