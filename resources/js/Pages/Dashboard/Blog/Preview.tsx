import { Head, Link, usePage } from "@inertiajs/react"

import DashboardLayout from "@/Layouts/Dashboard"

import { PageProps } from "@/types"

export default function BlogView() {
  const { auth, blog } = usePage<PageProps>().props

  return (
    <DashboardLayout>
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
        {auth.user.role != "user" && blog.status == "pending" && (
          <div className="mx-auto mt-2.5 flex max-w-4xl gap-x-1 text-sm text-white">
            <Link
              as="button"
              href={route("blog.status", {
                id: blog.id,
                action: "accepted"
              })}
              method="post"
              className="rounded bg-blue-600 px-2 py-1"
            >
              Accept
            </Link>
            <Link
              as="button"
              href={route("blog.status", {
                id: blog.id,
                action: "rejected"
              })}
              method="post"
              className="rounded bg-red-600 px-2 py-1"
            >
              Reject
            </Link>
          </div>
        )}
      </div>
    </DashboardLayout>
  )
}
