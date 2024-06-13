import { PropsWithChildren } from "react"

export default function AuthLayout({ children }: PropsWithChildren<{}>) {
  return (
    <div className="mx-auto flex h-full w-full flex-col items-center justify-center bg-[url('/assets/images/background.webp')] bg-cover bg-center">
      <div className="w-full max-w-[420px]">
        <img
          src="/assets/images/logo.webp"
          alt="PsycAppoint Logo"
          className="mx-auto pb-6"
        />
        {children}
      </div>
    </div>
  )
}
