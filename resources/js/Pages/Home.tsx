import { Link, usePage } from "@inertiajs/react"

import HomeLayout from "@/Layouts/Home"
import Alert from "@/Components/Alert"

import { PageProps } from "@/types"

export default function Home() {
  const { status, specialists } = usePage<PageProps>().props

  return (
    <HomeLayout>
      <div className="bg-white px-5 py-4">
        <Alert message={status} />
        <div className="mb-4 flex gap-x-2">
          <div className="flex flex-col gap-y-2.5">
            <div className="text-3xl font-bold">
              Butuh Teman Cerita? Yuk, Buat Janji di PsycAppoint!
            </div>
            <div className="text-base">
              Punya masalah soal cinta, keluarga, kerjaan, atau hal pribadi? Di
              PsycAppoint, kamu bisa bikin janji bersama konselor, terapis, atau
              psikolog dengan mudah. Curhatin apa aja yang bikin kamu kepikiran
              dan dapatkan saran serta dukungan yang kamu butuhin. Yuk,
              bareng-bareng kita prioritaskan dan menjaga kesehatan mental kita.
            </div>
            <Link
              href={route("appointment.home")}
              className="w-fit rounded bg-[#800080] px-3 py-2 text-sm font-semibold text-white"
            >
              Buat Janji Sekarang
            </Link>
            <div className="text-sm">
              Sudah membuat perjanjian?, cek status nya&nbsp;
              <Link
                href={route("appointment.manage")}
                className="hover:text-[#800080] hover:underline"
              >
                disini
              </Link>
              .
            </div>
          </div>
          <img
            src="/assets/images/sharing.webp"
            className="mb-auto h-auto w-40 rounded"
          />
        </div>
        <div className="mb-2.5 text-3xl font-bold">Our Specialist</div>
        <div className="grid auto-cols-max grid-flow-col gap-x-2">
          {specialists.map((v, i) => (
            <img
              src={`${v.avatar}?s=128&d=wavatar&r=pg`}
              className="h-14 w-auto rounded-full"
              key={i}
            />
          ))}
        </div>
      </div>
    </HomeLayout>
  )
}
