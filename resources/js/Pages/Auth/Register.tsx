import { FormEventHandler, useEffect } from "react"
import { Head, Link, useForm } from "@inertiajs/react"

import AuthLayout from "@/Layouts/Auth"
import InputAuth from "@/Components/InputAuth"

export default function Register({ status }: { status?: string }) {
  const { data, setData, clearErrors, post, processing, errors, reset } =
    useForm({
      name: "",
      email: "",
      address: "",
      phone: "",
      password: "",
      password_confirmation: ""
    })

  useEffect(() => {
    return () => {
      reset("password", "password_confirmation")
    }
  }, [])

  const submit: FormEventHandler = (e) => {
    e.preventDefault()

    post(route("register"))
  }
  return (
    <>
      <Head title="Register" />
      <AuthLayout>
        <form
          className="flex flex-col gap-2 rounded-lg bg-white px-6 py-8 shadow"
          onSubmit={submit}
        >
          <div className="pb-3 text-center text-xl font-bold uppercase">
            Register
          </div>
          <div className="flex flex-col gap-3 py-2.5">
            <InputAuth
              icon="ri-user-3-line"
              type="text"
              placeholder="Nama"
              value={data.name}
              change={(e) => {
                setData("name", e.target.value)
                clearErrors("name")
              }}
              error={errors.name}
            />
            <InputAuth
              icon="ri-mail-line"
              type="email"
              placeholder="Email"
              value={data.email}
              change={(e) => {
                setData("email", e.target.value)
                clearErrors("email")
              }}
              error={errors.email}
            />
            <InputAuth
              icon="ri-home-4-line"
              type="text"
              placeholder="Alamat"
              value={data.address}
              change={(e) => {
                setData("address", e.target.value)
                clearErrors("address")
              }}
              error={errors.address}
            />
            <InputAuth
              icon="ri-phone-line"
              type="number"
              placeholder="No. Telp"
              value={data.phone}
              change={(e) => {
                setData("phone", e.target.value)
                clearErrors("phone")
              }}
              error={errors.phone}
            />
            <InputAuth
              icon="ri-lock-line"
              type="password"
              placeholder="Kata Sandi"
              value={data.password}
              change={(e) => {
                setData("password", e.target.value)
                clearErrors("password")
              }}
              error={errors.password}
            />
            <InputAuth
              icon="ri-lock-line"
              type="password"
              placeholder="Konfirmasi Kata Sandi"
              value={data.password_confirmation}
              change={(e) => {
                setData("password_confirmation", e.target.value)
                clearErrors("password_confirmation")
              }}
              error={errors.password_confirmation}
            />
            <button className="mt-3 w-full rounded bg-[#9745d2] px-2.5 py-2 font-bold text-gray-200 transition-colors hover:text-white">
              Register
            </button>
          </div>
          <div className="text-center text-sm font-semibold">
            Sudah Memiliki Akun?&nbsp;
            <Link
              href="/"
              className="transition-colors hover:text-[#9745d2] hover:underline"
            >
              Log In
            </Link>
          </div>
        </form>
      </AuthLayout>
    </>
  )
}
