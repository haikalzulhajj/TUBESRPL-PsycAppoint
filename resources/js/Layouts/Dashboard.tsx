import { ReactNode, useEffect, useRef, useState } from "react"
import { Head, Link, usePage } from "@inertiajs/react"

import Sidebar from "@/Components/Sidebar"

import { PageProps } from "@/types"

export default function DashboardLayout({ children }: { children: ReactNode }) {
  const { auth } = usePage<PageProps>().props

  const [popup, setPopup] = useState<boolean>(false)
  const account = useRef<HTMLDivElement | null>(null)

  useEffect(() => {
    const handleOutSideClick = (event: any) => {
      if (popup && !account.current?.contains(event.target)) {
        setPopup(false)
      }
    }

    window.addEventListener("mousedown", handleOutSideClick)

    return () => {
      window.removeEventListener("mousedown", handleOutSideClick)
    }
  }, [account, popup])
  return (
    <>
      <Head title="Dashboard" />
      <div className="relative h-full w-full">
        <div className="sticky z-[1] flex w-full items-center justify-between bg-white px-2.5 py-3 shadow">
          <Link href={route("home")}>
            <img src="/assets/images/logo.webp" className="h-6" />
          </Link>
          <button
            className="flex items-center gap-x-2 text-[15px] font-bold text-[#6F2C80]"
            onClick={() => setPopup(popup ? false : true)}
          >
            <span>{auth.user.name}</span>
            <img
              src={`${auth.user.avatar}?s=64&d=wavatar&r=pg`}
              className="h-8 rounded-full"
            />
          </button>
        </div>
        <div
          className={`absolute right-2.5 top-12 z-[2] flex w-full max-w-72 flex-col gap-y-2.5 rounded-lg bg-white py-4 text-[#6F2C80] shadow-md ${popup ? "visible" : "invisible"}`}
          ref={account}
        >
          <div className="flex h-[26px] items-center justify-center px-3 text-sm font-semibold text-[#6F2C80]">
            {auth.user.email}
            <button
              className="absolute right-3 top-4 flex items-center rounded-full bg-gray-50 px-[5px] text-base transition-colors duration-300 hover:bg-[#6F2C80] hover:text-white"
              onClick={() => setPopup(popup ? false : true)}
            >
              <i className="bi bi-x mt-0.5"></i>
            </button>
          </div>
          <div className="flex flex-col justify-center gap-y-1">
            <img
              src={`${auth.user.avatar}?s=128&d=wavatar&r=pg`}
              className="mx-auto h-20 rounded-full"
            />
            <div className="text-center">Hi, {auth.user.name}!</div>
          </div>
          <div className="flex flex-col gap-y-1 px-5">
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
          <div className="px-5 py-2">
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
          <div className="text-center text-xs font-semibold">
            &copy;PsycAppoint
          </div>
        </div>
        <div className="flex h-full max-h-[calc(100%-56px)] w-full">
          <Sidebar>
            <Sidebar.Link href={route("dashboard")} icon="bi bi-house">
              Home
            </Sidebar.Link>
            {auth.user.role != "user" && (
              <Sidebar.Link
                href={route("users.manage")}
                icon="bi bi-person-gear"
              >
                Manage Users
              </Sidebar.Link>
            )}
            <Sidebar.Link
              href={route("appointment.manage")}
              icon="bi bi-people"
            >
              Appointment
            </Sidebar.Link>
            <Sidebar.Link href={route("blog.manage")} icon="bi bi-newspaper">
              Blog
            </Sidebar.Link>
            <Sidebar.Link href={route("journal.manage")} icon="bi bi-book">
              Journal
            </Sidebar.Link>
          </Sidebar>
          <div className="w-full max-w-[calc(100%-15rem)] overflow-hidden">
            <div className="h-full overflow-auto p-0.5">{children}</div>
          </div>
        </div>
      </div>
    </>
  )
}
