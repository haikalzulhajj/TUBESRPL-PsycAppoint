import { useEffect, useState } from "react"

const Alert = ({ message }: { message: string | null }) => {
  const [show, setShow] = useState(message ? true : false)

  useEffect(() => {
    setShow(message ? true : false)
  }, [message])

  return (
    <div
      className={`relative mb-2 rounded bg-emerald-600 px-2 py-1 text-sm text-white ${show ? "block" : "hidden"}`}
    >
      {message?.split("Code")[0]}
      <button
        className="absolute inset-y-1.5 right-2"
        onClick={(e) => setShow(false)}
        type="button"
      >
        <i className="bi bi-x mt-0.5"></i>
      </button>
    </div>
  )
}

const AlertError = ({ message }: { message: string | null | undefined }) => {
  const [show, setShow] = useState(message ? true : false)

  useEffect(() => {
    setShow(message ? true : false)
  }, [message])

  return (
    <div
      className={`relative mb-2 rounded bg-red-600 px-2 py-1 text-sm text-white ${show ? "block" : "hidden"}`}
    >
      {message?.split("Code")[0]}
      <button
        className="absolute inset-y-1.5 right-2"
        onClick={(e) => setShow(false)}
        type="button"
      >
        <i className="bi bi-x mt-0.5"></i>
      </button>
    </div>
  )
}

Alert.Error = AlertError

export default Alert
