import { FormEventHandler } from "react"
import { Head, useForm, usePage } from "@inertiajs/react"

import HomeLayout from "@/Layouts/Home"

import Select from "@/Components/Select"
import Input from "@/Components/Input"
import TextArea from "@/Components/TextArea"

import { PageProps, Specialist } from "@/types"

export default function AppointmentHome() {
  const { specialists } = usePage<PageProps>().props

  const specialist = Object.groupBy(
    specialists as any,
    ({ service }: { service: any }) => service
  ) as unknown as { [key: string]: Specialist[] }

  const { data, setData, post, clearErrors, processing, errors } = useForm<{
    type: string
    id: string
    dateTime: string
    message: string
    payment: File | null
  }>({
    type: "Counselor",
    id: specialist["Counselor"] ? specialist["Counselor"][0].id : "",
    dateTime: "",
    message: "",
    payment: null
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("appointment.create"))
  }
  return (
    <HomeLayout>
      <Head title="Appointment" />
      <form
        className="flex flex-col gap-y-2 bg-white px-5 py-4"
        onSubmit={submit}
      >
        <div className="mb-2 border-b border-b-gray-200 pb-3 text-3xl font-bold">
          Book Appointment
        </div>
        <div className="mb-3 rounded bg-[#6F2C80] px-6 py-5 text-white">
          <div className="mb-4 border-b border-b-[#ffffff40] pb-3 text-2xl font-bold">
            Specialist Information
          </div>
          <div className="flex flex-col gap-y-2 text-[15px]">
            <p>
              <strong>Counselor:</strong> Counselors help clients work through
              emotional and mental health issues by providing guidance and
              support. They often work with individuals, groups, or families to
              address specific problems or improve overall mental health.
            </p>
            <p>
              <strong>Psychologist:</strong> Psychologists are trained in the
              science of behavior and mental processes. They diagnose and treat
              mental health disorders, conduct psychological testing, and
              provide therapy. Psychologists often have specialized training in
              specific areas of psychology.
            </p>
            <p>
              <strong>Therapist:</strong> Therapists provide psychotherapy to
              help clients understand and manage their emotions, thoughts, and
              behaviors. They may use various therapeutic techniques to help
              clients cope with stress, anxiety, depression, and other mental
              health issues.
            </p>
          </div>
        </div>
        <div className="mb-4 flex flex-col gap-y-1.5">
          <Select
            label="Tipe Specialist"
            option={[
              { name: "Counselor", value: "Counselor" },
              { name: "Psychologist", value: "Psychologist" },
              { name: "Therapist", value: "Therapist" }
            ]}
            change={(e) =>
              setData({
                ...data,
                type: e.target.value,
                id: specialist[e.target.value][0].id
              })
            }
          />
          <Select
            label="Nama Specialist"
            option={specialist[data.type].map((v) => ({
              name: v.name,
              value: v.id
            }))}
            change={(e) => {
              setData({
                ...data,
                id: e.target.value
              })
            }}
            error={errors.id}
          />
          <Input
            label="Tanggal dan Waktu"
            type="datetime-local"
            change={(e) => {
              clearErrors("dateTime")
              setData("dateTime", e.target.value)
            }}
            error={errors.dateTime}
            required
          />
          <TextArea
            label="Pesan"
            change={(e) => {
              clearErrors("message")
              setData("message", e.target.value)
            }}
            error={errors.message}
          />
        </div>
        <div className="mb-2 border-b border-b-gray-200 pb-3 text-3xl font-bold">
          Payment
        </div>
        <div className="mb-4 flex flex-col gap-y-1.5">
          <ul className="ml-4 list-disc">
            <li>Counselling = Rp 200.000/session</li>
            <li>Psychologist Consultation = Rp 200.000/session</li>
            <li>Physiotherapy = Rp 100.000/session</li>
          </ul>
          <Input.File
            label="Bukti Pembayaran"
            change={(e) => {
              clearErrors("payment")
              setData("payment", e.target.files ? e.target.files[0] : null)
            }}
            error={errors.payment}
          />
        </div>
        <button
          className="ml-auto w-fit rounded-md bg-[#800080] px-2.5 py-1 text-sm font-medium text-white disabled:cursor-not-allowed"
          disabled={processing}
        >
          Buat Perjanjian
        </button>
      </form>
    </HomeLayout>
  )
}
