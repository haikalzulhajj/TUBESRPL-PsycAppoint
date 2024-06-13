import { ChangeEvent } from "react"

export default function ({
  label,
  option,
  selected,
  error,
  required,
  change
}: {
  label: string
  option: { name: string | number; value: string | number }[]
  selected?: string
  error?: string
  required?: boolean
  change?: (e: ChangeEvent<HTMLSelectElement>) => void
}) {
  return (
    <div className="flex flex-col">
      <div className="flex flex-col gap-y-1">
        <label
          className="text-[15px] font-semibold"
          htmlFor={label.replace(/ /g, "_").toLowerCase()}
        >
          {label}
        </label>
        {option && option.length > 0 ? (
          <select
            className="rounded border-gray-300 px-2 py-1 text-sm focus:border-[#800080] focus:ring-0"
            onChange={(e) => change && change(e)}
            id={label.replace(/ /g, "_").toLowerCase()}
            required={required}
          >
            {option.map((v) => (
              <option
                key={v.value}
                value={v.value}
                selected={v.value == selected}
              >
                {v.name}
              </option>
            ))}
          </select>
        ) : (
          <div className="flex items-center gap-x-1.5 rounded bg-red-500 px-2 py-1 text-white">
            <i className="bi bi-exclamation-circle mt-0.5"></i>
            <div className="text-sm">Tidak Ada Pilihan Untuk Opsi Ini!</div>
          </div>
        )}
      </div>
      <div className="text-sm text-red-600">{error}</div>
    </div>
  )
}
