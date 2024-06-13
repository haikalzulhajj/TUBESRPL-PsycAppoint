import { ChangeEvent } from "react"

const Input = ({
  label,
  type,
  value,
  error,
  required,
  disabled,
  change
}: {
  label: string
  type: "text" | "number" | "email" | "password" | "datetime-local"
  value?: string | number
  error?: string
  required?: boolean
  disabled?: boolean
  change?: (e: ChangeEvent<HTMLInputElement>) => void
}) => {
  return (
    <div className="flex flex-col">
      <div className="flex flex-col gap-y-1">
        <label
          className="text-[15px] font-semibold"
          htmlFor={label.replace(/ /g, "_").toLowerCase()}
        >
          {label}
        </label>
        <input
          className="rounded border-gray-300 px-2 py-1 text-sm focus:border-[#800080] focus:ring-0 disabled:bg-gray-200"
          type={type}
          defaultValue={value}
          id={label.replace(/ /g, "_").toLowerCase()}
          onChange={(e) => change && change(e)}
          required={required}
          disabled={disabled}
          autoComplete="off"
        />
      </div>
      <div className="text-sm text-red-600">{error}</div>
    </div>
  )
}

const InputFile = ({
  label,
  warning,
  error,
  required,
  change
}: {
  label: string
  warning?: string
  error?: string
  required?: boolean
  change?: (e: ChangeEvent<HTMLInputElement>) => void
}) => {
  return (
    <div className="flex flex-col">
      {warning && (
        <div className="rounded bg-yellow-500 px-2 py-1 text-sm text-white">
          {warning}
        </div>
      )}
      <div className="flex flex-col gap-y-1">
        <label
          className="font-medium"
          htmlFor={label.replace(/ /g, "_").toLowerCase()}
        >
          {label}
        </label>
        <input
          className="border-gray-300 text-sm focus:border-[#800080] focus:outline-none"
          type="file"
          accept="image/jpeg,image/png"
          id={label.replace(/ /g, "_").toLowerCase()}
          onChange={(e) => change && change(e)}
          required={required}
        />
      </div>
      <div className="text-sm text-red-600">{error}</div>
    </div>
  )
}

Input.File = InputFile

export default Input
