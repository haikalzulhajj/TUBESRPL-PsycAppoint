import { FormEventHandler } from "react"
import { Head, useForm, usePage } from "@inertiajs/react"

import DashboardLayout from "@/Layouts/Dashboard"

import Input from "@/Components/Input"
import Select from "@/Components/Select"

import { PageProps } from "@/types"

export default function UsersEdit() {
  const { auth, user } = usePage<PageProps>().props

  const { setData, post, processing, errors, clearErrors } = useForm({
    id: user.id,
    email: user.email,
    service: user.service,
    role: user.role
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("users.update"))
  }

  return (
    <DashboardLayout>
      <Head title="Edit User" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Edit User</div>
        <form className="flex flex-col gap-y-2 bg-white" onSubmit={submit}>
          <Input label="Nama" type="text" value={user.name} disabled={true} />
          <Input
            label="Email"
            type="email"
            value={user.email}
            change={(e) => setData("email", e.target.value)}
          />
          <Select
            label="Service"
            option={[
              { name: "None", value: "none" },
              { name: "Counselor", value: "Counselor" },
              { name: "Psychologist", value: "Psychologist" },
              { name: "Therapist", value: "Therapist" }
            ]}
            change={(e) => setData("service", e.target.value)}
            selected={user.service}
          />
          {auth.user.role == "root" && (
            <Select
              label="Role"
              option={[
                { name: "Admin", value: "admin" },
                { name: "User", value: "user" }
              ]}
              change={(e) => setData("role", e.target.value)}
              selected={user.role}
            />
          )}
          <button
            className="ml-auto w-fit rounded-md bg-[#800080] px-2.5 py-1 text-sm font-medium text-white disabled:cursor-not-allowed"
            disabled={processing}
          >
            Update User
          </button>
        </form>
      </div>
    </DashboardLayout>
  )
}
