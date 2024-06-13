import { Head, usePage } from "@inertiajs/react"

import HomeLayout from "@/Layouts/Home"

import { PageProps } from "@/types"

export default function JournalView() {
  const { journal } = usePage<PageProps>().props

  return (
    <HomeLayout>
      <Head title="Journal" />
      <div className="rounded bg-white px-5 py-4">
        <div className="mx-auto mb-6 flex max-w-4xl flex-col gap-y-1">
          <div className="text-3xl font-bold">{journal.title}</div>
          <div className="flex flex-row items-center gap-x-2 font-medium">
            <img
              src={`${journal.avatar}?s=32&d=wavatar&r=pg`}
              className="h-7 rounded-full"
            />
            <span>By {journal.creator}</span>
          </div>
        </div>
        <div
          className="mx-auto max-w-4xl"
          dangerouslySetInnerHTML={{ __html: journal.content }}
        ></div>
      </div>
    </HomeLayout>
  )
}
