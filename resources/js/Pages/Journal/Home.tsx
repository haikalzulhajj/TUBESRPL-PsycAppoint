import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import HomeLayout from "@/Layouts/Home"
import Pagination from "@/Components/Pagination"

import { PageProps } from "@/types"

export default function JournalHome() {
  const { journals } = usePage<PageProps>().props

  const { setData, get } = useForm({
    search: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    get(route("blog.home"))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD MMM")
  }
  return (
    <HomeLayout>
      <Head title="Journal" />
      <div className="mx-auto flex w-full max-w-5xl flex-col gap-y-3 px-5 py-4">
        <div className="mb-1 flex flex-row justify-between">
          <div className="text-3xl font-bold">Journal</div>
          <form
            className="flex h-fit w-full max-w-60 items-center gap-x-2 rounded-full border-2 border-gray-300 px-3 text-sm"
            onSubmit={submit}
          >
            <input
              className="w-full border-none bg-transparent pl-0 text-gray-700 outline-none focus:ring-0"
              placeholder="Search"
              type="text"
              onChange={(e) => setData("search", e.target.value)}
            />
            <button type="submit">
              <i className="ri-search-line text-base text-gray-500"></i>
            </button>
          </form>
        </div>
        <div className="flex flex-col gap-2.5">
          {journals.data.length > 0 ? (
            journals.data.map((v, i) => (
              <div
                className="flex h-full flex-col justify-between gap-y-1.5 rounded border px-4 py-3"
                key={i}
              >
                <div className="flex flex-col gap-y-1.5">
                  <Link
                    href={route("journal.view", { slug: v.slug })}
                    className="text-xl font-semibold"
                  >
                    {v.title}
                  </Link>
                  <div className="font text-sm">{v.preview}...</div>
                </div>
                <div className="flex flex-row items-center justify-between gap-x-1.5 py-2">
                  <div className="flex flex-row items-center gap-x-1 text-sm">
                    <img
                      src={`${v.avatar}?s=32&d=wavatar&r=pg`}
                      className="h-5 rounded-full"
                    />
                    <span>{v.creator}</span>
                  </div>
                  <div className="text-xs text-gray-500">
                    {formatDate(v.created_at)}
                  </div>
                </div>
              </div>
            ))
          ) : (
            <div className="col-span-3 flex w-full flex-col items-center justify-center rounded border border-gray-100 px-3 py-2">
              <i className="ri-newspaper-line text-[10rem] opacity-25"></i>
              <div className="mb-12">Tidak Ada Journal Untuk Ditampilkan!</div>
            </div>
          )}
        </div>
        <Pagination data={journals} />
      </div>
    </HomeLayout>
  )
}
