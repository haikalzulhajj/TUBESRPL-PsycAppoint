import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import DashboardLayout from "@/Layouts/Dashboard"
import Alert from "@/Components/Alert"
import Pagination from "@/Components/Pagination"

import { PageProps } from "@/types"

export default function AppointmentRequest() {
  const { status, blogs } = usePage<PageProps>().props

  const { data, setData, get } = useForm({
    search: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    get(route("blog.manage"))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD/MM/YYYY HH:mm:ss")
  }
  return (
    <DashboardLayout>
      <Head title="Manage Blog" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Manage Blog</div>
        <Alert message={status} />
        <div className="mb-3 flex items-center justify-between">
          <Link
            href={route("blog.create")}
            className="h-full w-fit rounded bg-[#800080] px-2 py-1 text-sm font-semibold text-white"
          >
            Buat Blog
          </Link>
          <form
            className="flex h-fit w-full max-w-60 items-center gap-x-2.5 rounded-full border-2 border-gray-300 px-3 text-sm"
            onSubmit={submit}
          >
            <input
              className="w-full border-none bg-transparent px-0 py-1 text-sm text-gray-700 outline-none focus:ring-0"
              placeholder="Search"
              type="text"
              defaultValue={data.search}
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
              <th className="border px-2 py-1.5 text-left">Creator</th>
              <th className="border px-2 py-1.5 text-left">Judul</th>
              <th className="border px-2 py-1.5 text-left">Di Buat Pada</th>
              <th className="border px-2 py-1.5 text-left" colSpan={2}>
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            {blogs.data.length > 0 ? (
              blogs.data.map((v, i) => (
                <tr key={i.toString()}>
                  <td className="text-center">{i + blogs.from}</td>
                  <td className="border px-2 py-1.5">
                    <div className="flex flex-row items-center gap-x-2 font-medium">
                      <img
                        src={`${v.avatar}?s=32&d=wavatar&r=pg`}
                        className="h-7 rounded-full"
                      />
                      <span>{v.creator}</span>
                    </div>
                  </td>
                  <td className="border px-2 py-1.5">{v.title}</td>
                  <td className="border px-2 py-1.5">
                    {formatDate(v.created_at)}
                  </td>
                  <td className="px-2 py-1.5">
                    <div
                      className={`${
                        v.status == "rejected"
                          ? "bg-red-500"
                          : v.status == "pending"
                            ? "bg-yellow-500"
                            : "bg-green-600"
                      } w-fit rounded px-1.5 py-0.5 text-sm text-white`}
                    >
                      {v.status}
                    </div>
                  </td>
                  <td className="px-2 py-1.5">
                    <div className="flex items-center gap-x-1 text-white">
                      <Link
                        href={route("blog.preview", { slug: v.slug })}
                        className="rounded bg-yellow-500 px-2 py-1"
                      >
                        <i className="ri-eye-line"></i>
                      </Link>
                      <Link
                        href={route("blog.edit", { id: v.id })}
                        className="rounded bg-blue-600 px-2 py-1"
                      >
                        <i className="ri-pencil-line"></i>
                      </Link>
                      <Link
                        as="button"
                        href={route("blog.delete", { id: v.id })}
                        className="rounded bg-red-500 px-2 py-1"
                        method="post"
                      >
                        <i className="ri-delete-bin-line"></i>
                      </Link>
                    </div>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td className="px-2 py-1.5 text-center" colSpan={5}>
                  Tidak Ada Post!
                </td>
              </tr>
            )}
          </tbody>
        </table>
        <Pagination data={blogs} />
      </div>
    </DashboardLayout>
  )
}
