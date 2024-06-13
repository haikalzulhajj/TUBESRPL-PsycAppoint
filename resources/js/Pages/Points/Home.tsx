import { Head, Link, usePage } from "@inertiajs/react"

import HomeLayout from "@/Layouts/Home"
import Alert from "@/Components/Alert"
import Pagination from "@/Components/Pagination"

import { PageProps } from "@/types"

export default function PointHome() {
  const { auth, status, errors, coupons } = usePage<PageProps>().props

  const redeem = [100, 250, 500, 1000]

  const formatNumber = (e: number) => {
    return new Intl.NumberFormat("id-ID").format(e)
  }

  return (
    <HomeLayout>
      <Head title="Points" />
      <div className="px-5 py-4">
        <div className="mb-5 text-3xl font-bold">Points</div>
        <Alert message={status} />
        <Alert.Error message={errors.points} />
        <div className="mb-2 font-semibold">
          Points Kamu: {auth.user.points}
        </div>
        <div className="grid grid-cols-2 gap-2">
          {redeem.map((v) => (
            <div
              className="coupon flex justify-between rounded py-4 pl-10 pr-4"
              style={{
                background: "linear-gradient(rgb(128 0 128), rgb(111 44 128))"
              }}
            >
              <div className="text-xl font-semibold text-white">
                Kupon Rp {formatNumber(Number(v * 100))}
                <div className="text-sm font-normal">
                  Berlaku Hingga: 31/12/2025
                </div>
              </div>
              <Link
                as="button"
                href={route("points.redeem", { amount: v })}
                method="post"
                className="leading-5 text-white"
              >
                {v}
                <br />
                Points
              </Link>
            </div>
          ))}
        </div>
        <div className="mb-2.5 mt-4 text-lg font-semibold">Kupon Saya</div>
        <div className="flex flex-col gap-y-2">
          {coupons.total > 0 ? (
            coupons.data.map((v) => (
              <div
                className="coupon flex items-center justify-between rounded py-4 pl-10 pr-4"
                style={{
                  background: "linear-gradient(rgb(128 0 128), rgb(111 44 128))"
                }}
                key={v.id}
              >
                <div className="text-xl font-semibold text-white">
                  Kupon Rp {formatNumber(Number(v.coupon))}
                  <div className="text-sm font-normal">
                    Berlaku Hingga: 31/12/2025
                  </div>
                </div>
                <div className="text-white">{v.code}</div>
              </div>
            ))
          ) : (
            <div className="text-[15px]">Kamu Tidak Memiliki Kupon Apapun!</div>
          )}
        </div>
        <Pagination data={coupons} />
      </div>
    </HomeLayout>
  )
}
