import { ReactNode } from "react"
import { Link, usePage } from "@inertiajs/react"

import { PageProps } from "@/types"

export default function AccountLayout({ children }: { children: ReactNode }) {
  const { auth } = usePage<PageProps>().props

  return (
    <>
      <div className="relative h-full w-full bg-gray-50">
        <div className="sticky z-[1] bg-white shadow">
          <div className="mx-auto flex w-full max-w-5xl items-center justify-between px-2.5 py-3">
            <Link href={route("home")}>
              <img src="/assets/images/logo.webp" className="h-6" />
            </Link>
            <div className="flex items-center gap-x-2 text-[15px] font-bold text-[#6F2C80]">
              <span>{auth.user.name}</span>
              <img
                src={`${auth.user.avatar}?s=64&d=wavatar&r=pg`}
                className="h-8 rounded-full"
              />
            </div>
          </div>
        </div>
        <div className="mx-auto flex h-full max-h-[calc(100%-56px)] w-full max-w-5xl flex-col gap-y-3 px-2.5 py-3">
          <div className="flex flex-row gap-x-2.5">
            <div className="h-fit w-full max-w-60 rounded border-gray-100 bg-white p-4 shadow">
              <div className="mb-2 flex items-end gap-x-2.5">
                <img
                  src={`${auth.user.avatar}?s=256&d=wavatar&r=pg`}
                  className="h-28 rounded-full shadow"
                />
                <a
                  href="https://gravatar.com/profile"
                  className="relative ml-auto rounded-md bg-[#800080] px-2 py-1 text-sm font-semibold text-white transition-colors duration-300 hover:bg-[#6F2C80]"
                  target="_blank"
                >
                  Gravatar <i className="ri-arrow-right-up-line text-xs"></i>
                </a>
              </div>
              <div className="text-lg font-semibold">{auth.user.name}</div>
              <div className="text-sm leading-3">{auth.user.email}</div>
              <div className="flex flex-col gap-y-0.5 py-3">
                <Link
                  href={route("home")}
                  className="relative flex items-center gap-x-2 text-lg"
                >
                  <i className="ri-home-4-line"></i>
                  <div className="text-[15px] font-semibold">Home</div>
                </Link>
                <Link
                  href={route("account.home")}
                  className="relative flex items-center gap-x-2 text-lg"
                >
                  <i className="ri-user-3-line"></i>
                  <div className="text-[15px] font-semibold">Account</div>
                </Link>
              </div>
              <Link
                href={route("logout")}
                method="post"
                as="button"
                className="relative flex items-center gap-x-2 text-lg"
              >
                <i className="ri-logout-box-line"></i>
                <div className="text-[15px] font-semibold">Log Out</div>
              </Link>
            </div>
            <div className="h-fit w-full max-w-[calc(100%-15rem)] rounded border-gray-100 bg-white p-4 shadow">
              {children}
            </div>
          </div>
        </div>
      </div>
    </>
  )
}
