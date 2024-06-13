import { ChangeEvent } from "react"

export default function ({
  icon,
  type,
  placeholder,
  value,
  error,
  change
}: {
  icon: string
  type: "text" | "number" | "email" | "password"
  placeholder: string
  value?: string | number
  error?: string
  change: (e: ChangeEvent<HTMLInputElement>) => void
}) {
  return (
    <div className="flex flex-col">
      <div className="relative flex items-center rounded border border-slate-300 bg-white">
        <i className={`${icon} rounded-l px-2.5 py-2 text-gray-600`}></i>
        <input
          className="w-full border-0 bg-transparent p-2.5 text-sm focus:ring-0"
          type={type}
          placeholder={placeholder}
          onChange={(e) => change(e)}
          defaultValue={value}
          required
        />
      </div>
      <div className="text-sm text-red-500">{error}</div>
    </div>
  )
}
