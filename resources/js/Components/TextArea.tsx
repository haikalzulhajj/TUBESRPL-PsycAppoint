import { ChangeEvent } from "react"

export default function ({
  label,
  value,
  error,
  required,
  change
}: {
  label: string
  value?: string | number
  error?: string
  required?: boolean
  change?: (e: ChangeEvent<HTMLTextAreaElement>) => void
}) {
  return (
    <div className="flex flex-col">
      <div className="flex flex-col gap-y-1">
        <label
          className="font-medium"
          htmlFor={label.replace(/ /g, "_").toLowerCase()}
        >
          {label}
        </label>
        <textarea
          className="h-28 rounded border-gray-300 px-2 py-1 text-sm focus:border-[#800080] focus:ring-0"
          id={label.replace(/ /g, "_").toLowerCase()}
          onChange={(e) => change && change(e)}
          required={required}
        >
          {value}
        </textarea>
      </div>
      <div className="text-sm text-red-600">{error}</div>
    </div>
  )
}
