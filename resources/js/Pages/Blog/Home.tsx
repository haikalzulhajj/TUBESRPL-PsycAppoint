import { FormEventHandler } from "react"
import { Head, Link, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import HomeLayout from "@/Layouts/Home"

import { PageProps } from "@/types"

export default function BlogHome() {
  const { blogs } = usePage<PageProps>().props

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
      <Head title="Blog" />
      <div className="mx-auto flex w-full max-w-5xl flex-col gap-y-3 px-5 py-4">
        <div className="mb-1 flex flex-row justify-between">
          <div className="text-3xl font-bold">Blog</div>
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
        <div className="grid grid-cols-3 gap-2.5">
          {blogs.data.length > 0 ? (
            blogs.data.map((v, i) => (
              <div className="flex flex-col rounded bg-white shadow" key={i}>
                <img
                  src={`/storage/${v.heading}`}
                  className="h-40 rounded-t object-cover object-top"
                />
                <div className="flex h-full flex-col justify-between gap-y-1.5 px-4 py-3">
                  <div className="flex flex-col gap-y-1.5">
                    <Link
                      href={route("blog.view", { slug: v.slug })}
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
              </div>
            ))
          ) : (
            <div className="col-span-3 flex w-full flex-col items-center justify-center rounded border border-gray-100 px-3 py-2">
              <i className="ri-newspaper-line text-[10rem] opacity-25"></i>
              <div className="mb-12">Tidak Ada Blog Untuk Ditampilkan!</div>
            </div>
          )}
        </div>
        {blogs.total > blogs.per_page && (
          <div className="mx-auto flex w-fit flex-row items-center border-gray-100 bg-white px-2 py-1 shadow">
            <Link
              href={blogs.prev_page_url ?? ""}
              className={`flex rounded px-1.5 text-gray-600`}
            >
              <i className="bi bi-caret-left-fill mt-0.5"></i>
            </Link>
            <div className="px-2 text-base">
              Page {blogs.current_page} / {blogs.last_page}
            </div>
            <Link
              href={blogs.next_page_url ?? ""}
              className={`flex rounded px-1.5 text-gray-600`}
            >
              <i className="bi bi-caret-right-fill mt-0.5"></i>
            </Link>
          </div>
        )}
      </div>
    </HomeLayout>
  )
}
