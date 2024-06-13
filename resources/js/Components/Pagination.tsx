import { Link } from "@inertiajs/react"

import { Pagination } from "@/types"

export default function ({ data }: { data: Pagination }) {
  return (
    <>
      {data.total > data.per_page && (
        <div className="mx-auto mt-4 flex w-fit flex-row items-center rounded border bg-white px-2 py-1 shadow">
          <Link
            href={data.prev_page_url ?? ""}
            className={`flex rounded px-1.5 text-gray-600`}
          >
            <i className="bi bi-caret-left-fill mt-0.5"></i>
          </Link>
          <div className="px-2 text-base">
            Page {data.current_page} / {data.last_page}
          </div>
          <Link
            href={data.next_page_url ?? ""}
            className={`flex rounded px-1.5 text-gray-600`}
          >
            <i className="bi bi-caret-right-fill mt-0.5"></i>
          </Link>
        </div>
      )}
    </>
  )
}
