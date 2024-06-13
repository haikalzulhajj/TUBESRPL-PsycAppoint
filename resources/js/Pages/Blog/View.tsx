import { Head, usePage } from "@inertiajs/react"

import HomeLayout from "@/Layouts/Home"

import { PageProps } from "@/types"

export default function BlogView() {
  const { blog } = usePage<PageProps>().props

  return (
    <HomeLayout>
      <Head title="Blog" />
      <div className="rounded bg-white px-5 py-4">
        <img
          src={`/storage/${blog.heading}`}
          className="h-full max-h-96 w-full rounded object-cover object-top"
        />
        <div className="mx-auto my-6 flex max-w-4xl flex-col gap-y-1">
          <div className="text-3xl font-bold">{blog.title}</div>
          <div className="flex flex-row items-center gap-x-2 font-medium">
            <img
              src={`${blog.avatar}?s=32&d=wavatar&r=pg`}
              className="h-7 rounded-full"
            />
            <span>By {blog.creator}</span>
          </div>
        </div>
        <div
          className="mx-auto max-w-4xl"
          dangerouslySetInnerHTML={{ __html: blog.content }}
        ></div>
      </div>
    </HomeLayout>
  )
}
