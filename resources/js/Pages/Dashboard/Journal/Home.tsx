import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import DashboardLayout from "@/Layouts/Dashboard"
import Alert from "@/Components/Alert"

import { PageProps } from "@/types"

export default function JournalManage() {
  const { status, journals } = usePage<PageProps>().props

  const { data, setData, get } = useForm({
    search: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    get(route("journal.manage"))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD/MM/YYYY HH:mm:ss")
  }
  return (
    <DashboardLayout>
      <Head title="Manage Journal" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Manage Journal</div>
        <Alert message={status} />
        <div className="mb-3 flex items-center justify-between">
          <Link
            href={route("journal.create")}
            className="h-full w-fit rounded bg-[#800080] px-2 py-1 text-sm font-semibold text-white"
          >
            Buat Journal
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
              <th className="border px-2 py-1.5 text-left">Judul</th>
              <th className="border px-2 py-1.5 text-left" colSpan={2}>
                Di Buat Pada
              </th>
            </tr>
          </thead>
          <tbody>
            {journals.data.length > 0 ? (
              journals.data.map((v, i) => (
                <tr key={i.toString()}>
                  <td className="text-center">{i + journals.from}</td>
                  <td className="border px-2 py-1.5">{v.title}</td>
                  <td className="px-2 py-1.5">{formatDate(v.created_at)}</td>
                  <td className="px-2 py-1.5">
                    <div className="flex items-center gap-x-1 text-white">
                      <Link
                        href={route("journal.preview", { slug: v.slug })}
                        className="rounded bg-yellow-500 px-2 py-1"
                      >
                        <i className="ri-eye-line"></i>
                      </Link>
                      <Link
                        href={route("journal.edit", { id: v.id })}
                        className="rounded bg-blue-600 px-2 py-1"
                      >
                        <i className="ri-pencil-line"></i>
                      </Link>
                      <Link
                        as="button"
                        href={route("journal.delete", { id: v.id })}
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
                  Tidak Ada Journal!
                </td>
              </tr>
            )}
          </tbody>
        </table>
        {journals.total > journals.per_page && (
          <div className="mx-auto flex w-fit flex-row items-center border-gray-100 bg-white px-2 py-1 shadow">
            <Link
              href={journals.prev_page_url ?? ""}
              className={`flex rounded px-1.5 text-gray-600`}
            >
              <i className="bi bi-caret-left-fill mt-0.5"></i>
            </Link>
            <div className="px-2 text-base">
              Page {journals.current_page} / {journals.last_page}
            </div>
            <Link
              href={journals.next_page_url ?? ""}
              className={`flex rounded px-1.5 text-gray-600`}
            >
              <i className="bi bi-caret-right-fill mt-0.5"></i>
            </Link>
          </div>
        )}
      </div>
    </DashboardLayout>
  )
}
