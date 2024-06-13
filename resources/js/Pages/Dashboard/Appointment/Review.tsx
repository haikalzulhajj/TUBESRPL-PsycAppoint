import { FormEventHandler } from "react"
import { Head, useForm, usePage } from "@inertiajs/react"

import moment from "moment"

import TextArea from "@/Components/TextArea"
import DashboardLayout from "@/Layouts/Dashboard"

import { PageProps } from "@/types"

export default function AppointmentRequest() {
  const { auth, appointment } = usePage<PageProps>().props

  const { setData, post, processing } = useForm({
    review: "",
    feedback: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("appointment.completed", { id: appointment.id }))
  }

  const formatDate = (e: string) => {
    return moment(e).format("DD MMM YYYY, HH:mm")
  }
  return (
    <DashboardLayout>
      <Head title="Appointment Review & Feedback" />
      <div className="px-5 py-4">
        <div className="mx-auto flex max-w-5xl flex-col">
          <div className="mb-5 text-3xl font-bold">
            Appointment Review & Feedback
          </div>
          {appointment.status == "rejected" && (
            <div className="mb-1 rounded border-red-700 bg-red-600 px-2 py-1 text-sm text-white">
              Permintaan Ini Telah Ditolak Oleh {appointment.specialist_name}!
            </div>
          )}
          <div className="mb-2 flex justify-between">
            <div className="text-base font-medium">
              {auth.user.service == "none" ? "To" : "From"}:
            </div>
            <div className="flex flex-row items-center gap-x-2 font-medium">
              <img
                src={`${auth.user.service == "none" ? appointment.specialist_avatar : appointment.requester_avatar}?s=32&d=wavatar&r=pg`}
                className="h-6 rounded-full"
              />
              <span>
                {auth.user.service == "none"
                  ? appointment.specialist_name
                  : appointment.requester_name}
              </span>
            </div>
          </div>
          <form className="flex flex-col gap-y-2" onSubmit={submit}>
            <TextArea
              label="Review"
              change={(e) => setData("review", e.target.value)}
            />
            <TextArea
              label="Feedback"
              change={(e) => setData("feedback", e.target.value)}
            />
            <button
              className="ml-auto w-fit rounded-md bg-[#800080] px-2.5 py-1 text-sm font-medium text-white disabled:cursor-not-allowed"
              disabled={processing}
            >
              Submit
            </button>
          </form>
        </div>
      </div>
    </DashboardLayout>
  )
}
