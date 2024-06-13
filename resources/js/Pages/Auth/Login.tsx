import { FormEventHandler, useEffect } from "react"
import { Head, Link, useForm } from "@inertiajs/react"

import AuthLayout from "@/Layouts/Auth"
import InputAuth from "@/Components/InputAuth"

export default function Login({ status }: { status?: string }) {
  const { data, setData, clearErrors, post, processing, errors, reset } =
    useForm({
      email: "",
      password: "",
      remember: true
    })

  useEffect(() => {
    return () => {
      reset("password")
    }
  }, [])

  const submit: FormEventHandler = (e) => {
    e.preventDefault()

    post(route("login"))
  }

  return (
    <>
      <Head title="Log In" />
      <AuthLayout>
        <form
          className="flex flex-col gap-2 rounded-lg bg-white px-6 py-8 shadow"
          onSubmit={submit}
        >
          <div className="pb-3 text-center text-xl font-bold uppercase">
            Log In
          </div>
          {errors.email && (
            <div className="rounded border-red-700 bg-red-600 px-2 py-1 text-sm text-white">
              Invalid Email or Password!
            </div>
          )}
          <div className="flex flex-col gap-3 py-2.5">
            {status && (
              <div className="flex items-center gap-2.5 rounded bg-red-700 px-2.5 py-2 text-white">
                <i className="ri-error-warning-fill"></i>
                <span className="text-sm">{status}</span>
              </div>
            )}
            <InputAuth
              icon="ri-mail-line"
              type="email"
              placeholder="Email"
              value={data.email}
              change={(e) => {
                setData("email", e.target.value)
                clearErrors("email")
              }}
            />
            <InputAuth
              icon="ri-lock-line"
              type="password"
              placeholder="Kata Sandi"
              value={data.password}
              change={(e) => {
                setData("password", e.target.value)
                clearErrors("email")
              }}
            />
            <button className="mt-3 w-full rounded bg-[#9745d2] px-2.5 py-2 font-bold text-gray-200 transition-colors hover:text-white">
              Log In
            </button>
          </div>
          <div className="text-center text-sm font-semibold">
            Tidak Memiliki Akun?&nbsp;
            <Link
              href={route("register")}
              className="transition-colors hover:text-[#9745d2] hover:underline"
            >
              Register
            </Link>
          </div>
        </form>
      </AuthLayout>
    </>
  )
}
