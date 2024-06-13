import { Link } from "@inertiajs/react"
import { ReactNode } from "react"

const Sidebar = ({ children }: { children: ReactNode }) => {
  return (
    <div className="flex w-full max-w-60 flex-col justify-between bg-white px-2.5 py-3 shadow">
      <div className="flex flex-col gap-y-2.5">{children}</div>
      <Link
        href={route("logout")}
        method="post"
        as="button"
        className="relative flex items-center gap-x-2 text-lg text-[#800080]"
      >
        <i className="bi bi-box-arrow-left"></i>
        <div className="text-[15px] font-semibold">Log Out</div>
      </Link>
    </div>
  )
}

const SidebarLink = ({
  href,
  icon,
  children
}: {
  href: string
  icon?: string
  children: ReactNode
}) => {
  return (
    <Link
      href={href}
      className="relative flex items-center gap-x-2 text-lg text-[#800080]"
    >
      <i className={icon}></i>
      <div className="text-[15px] font-semibold">{children}</div>
    </Link>
  )
}

Sidebar.Link = SidebarLink

export default Sidebar
