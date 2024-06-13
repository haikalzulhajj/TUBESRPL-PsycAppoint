import { FormEventHandler, useState } from "react"
import { Head, useForm, usePage } from "@inertiajs/react"

import AccountLayout from "@/Layouts/Account"
import Alert from "@/Components/Alert"
import Input from "@/Components/Input"

import { PageProps } from "@/types"

export default function AccountHome() {
  const { user, status } = usePage<PageProps>().props

  const { setData, post, processing, errors, clearErrors, reset } = useForm({
    name: user.name,
    email: user.email,
    address: user.address,
    phone: user.phone_number,
    old_password: "",
    password: ""
  })

  useState(() => {
    return () => {
      reset("old_password", "password")
    }
    //@ts-ignore
  }, [])

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("account.update"))
  }

  return (
    <>
      <Head title="Account" />
      <AccountLayout>
        <div className="flex flex-col">
          <div className="mb-3 text-2xl font-bold">Informasi Akun</div>
          <Alert message={status} />
          <form
            className="flex flex-col gap-y-2 bg-white"
            onSubmit={submit}
            autoComplete="off"
          >
            <Input
              label="Nama"
              type="text"
              value={user.name}
              change={(e) => {
                setData("name", e.target.value)
                clearErrors("name")
              }}
              error={errors.name}
            />
            <Input
              label="Email"
              type="email"
              value={user.email}
              change={(e) => {
                setData("email", e.target.value)
                clearErrors("email")
              }}
              error={errors.email}
            />
            <Input
              label="Address"
              type="text"
              value={user.address}
              change={(e) => {
                setData("address", e.target.value)
                clearErrors("address")
              }}
              error={errors.address}
            />
            <Input
              label="No Telephone"
              type="number"
              value={user.phone_number}
              change={(e) => {
                setData("phone", e.target.value)
                clearErrors("phone")
              }}
              error={errors.phone}
            />
            <div className="relative mt-1.5 rounded border-amber-400 bg-amber-500 px-2 py-1 text-sm text-white">
              Kosongkan Bagian Ini Jika Tidak Ingin Mengganti Password!
            </div>
            <Input
              label="Kata Sandi Lama"
              type="password"
              change={(e) => {
                setData("old_password", e.target.value)
                clearErrors("old_password")
              }}
              error={errors.old_password}
            />
            <Input
              label="Kata Sandi Baru"
              type="password"
              change={(e) => {
                setData("password", e.target.value)
                clearErrors("password")
              }}
              error={errors.password}
            />
            <button
              className="ml-auto w-fit rounded-md bg-[#800080] px-2.5 py-1 text-sm font-medium text-white disabled:cursor-not-allowed"
              disabled={processing}
            >
              Update
            </button>
          </form>
        </div>
      </AccountLayout>
    </>
  )
}
