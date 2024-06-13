import { useState } from "react"
import { Head, Link, usePage } from "@inertiajs/react"

import moment from "moment"

import DashboardLayout from "@/Layouts/Dashboard"

import { PageProps } from "@/types"

export default function AppointmentRequest() {
  const { auth, appointment } = usePage<PageProps>().props

  const [show, setShow] = useState(false)

  const formatDate = (e: string) => {
    return moment(e).format("DD MMM YYYY, HH:mm")
  }
  return (
    <DashboardLayout>
      <Head title="Appointment Request" />
      <div className="px-5 py-4">
        <div className="mx-auto flex max-w-5xl flex-col">
          <div className="mb-5 text-3xl font-bold">Appointment Request</div>
          {appointment.status == "rejected" && (
            <div className="mb-1 rounded border-red-700 bg-red-600 px-2 py-1 text-sm text-white">
              Permintaan Ini Telah Ditolak Oleh&nbsp;
              {auth.user.name == appointment.specialist_name
                ? "Anda"
                : appointment.specialist_name}
              !
            </div>
          )}
          {appointment.status == "completed" && (
            <div className="mb-1 rounded border-green-700 bg-green-600 px-2 py-1 text-sm text-white">
              Permintaan Ini Telah Diselesaikan!
            </div>
          )}
          <div className="mb-3 text-base">
            {`Kamu telah ${auth.user.service == "none" ? "mengirim" : "mendapat"} permintaan ${auth.user.service == "none" ? "ke" : "dari"} ${
              auth.user.service == "none"
                ? appointment.specialist_name
                : appointment.requester_name
            } untuk melakukan pertemuan pada ${formatDate(appointment.time)} di ${appointment.address}.`}
          </div>
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
          <div className="min-h-20 text-base leading-5">
            {appointment.message}
          </div>
          <div className="text-sm">
            <span>
              Bukti Pembayaran:&nbsp;
              <button
                className="hover:text-[#6F2C80] hover:underline"
                onClick={() => setShow(true)}
              >
                {appointment.payment.split("/")[3]}
              </button>
            </span>
          </div>
          {auth.user.service != "none" && appointment.completed == 1 && (
            <>
              <div className="mt-5">
                <div className="font-medium">Review:</div>
                <div className="mb-3 min-h-20">{appointment.review ?? "-"}</div>
                <div className="font-medium">Feedback:</div>
                <div className="min-h-20">{appointment.feedback ?? "-"}</div>
              </div>
            </>
          )}
          {auth.user.service != "none" && !appointment.completed && (
            <div className="mt-2.5 flex flex-row gap-x-1 text-sm font-medium text-white">
              {appointment.status == "requested" ? (
                <>
                  <Link
                    as="button"
                    href={route("appointment.status", {
                      id: appointment.id,
                      action: "accepted"
                    })}
                    method="post"
                    className="rounded bg-blue-600 px-2 py-1"
                  >
                    Terima
                  </Link>
                  <Link
                    as="button"
                    href={route("appointment.status", {
                      id: appointment.id,
                      action: "rejected"
                    })}
                    method="post"
                    className="rounded bg-red-600 px-2 py-1"
                  >
                    Tolak
                  </Link>
                </>
              ) : (
                <Link
                  as="button"
                  href={route("appointment.status", {
                    id: appointment.id,
                    action: "completed"
                  })}
                  method="post"
                  className="rounded bg-green-600 px-2 py-1"
                >
                  Selesai
                </Link>
              )}
            </div>
          )}
          <div
            className={`absolute left-0 top-0 z-50 flex h-full w-full bg-[rgba(0,0,0,0.15)] px-4 ${
              show
                ? "visible opacity-100 transition-opacity"
                : "invisible opacity-0 transition-all"
            } ease-linear`}
          >
            <div className="m-auto flex h-full max-h-[90%] w-full max-w-5xl flex-col rounded bg-white p-4">
              <div className="relative w-full border-b pb-4">
                <span className="text-lg font-semibold">Bukti Pembayaran</span>
                <button
                  className="absolute right-0 top-0.5"
                  onClick={(e) => setShow(false)}
                >
                  <i className="bi bi-x-lg"></i>
                </button>
              </div>
              <div className="overflow-hidden pt-4">
                <div className="h-full max-h-full overflow-auto">
                  <img
                    src={`/storage/${appointment.payment}`}
                    className="m-auto rounded"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </DashboardLayout>
  )
}
