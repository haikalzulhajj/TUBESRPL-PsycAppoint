import { FormEventHandler } from "react"
import { Head, useForm } from "@inertiajs/react"

import { CKEditor } from "@ckeditor/ckeditor5-react"
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"

import DashboardLayout from "@/Layouts/Dashboard"
import Input from "@/Components/Input"

export default function BlogCreate() {
  const { setData, post, processing, errors, clearErrors } = useForm<{
    title: string
    heading: File | null
    content: string
  }>({
    title: "",
    heading: null,
    content: ""
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("blog.post"))
  }

  return (
    <DashboardLayout>
      <Head title="Create Blog" />
      <form
        className="flex flex-col gap-y-2 bg-white px-5 py-4"
        onSubmit={submit}
        autoComplete="off"
      >
        <div className="mb-2 border-b border-b-gray-200 pb-3 text-3xl font-bold">
          New Blog
        </div>
        <Input.File
          label="Heading"
          error={errors.heading}
          change={(e) => {
            setData("heading", e.target.files ? e.target.files[0] : null)
            clearErrors("heading")
          }}
        />
        <Input
          label="Judul"
          type="text"
          error={errors.title}
          change={(e) => {
            setData("title", e.target.value)
            clearErrors("title")
          }}
        />
        <div className="flex flex-col">
          <div className="flex flex-col gap-y-1">
            <div className="text-[15px] font-semibold">Isi Konten</div>
            <CKEditor
              editor={ClassicEditor}
              config={{
                removePlugins: [
                  "Image",
                  "ImageCaption",
                  "ImageStyle",
                  "ImageToolbar",
                  "ImageUpload",
                  "EasyImage",
                  "CKFinder"
                ]
              }}
              onChange={(event, editor) => {
                setData("content", editor.getData())
                clearErrors("content")
              }}
            />
          </div>
          <div className="text-sm text-red-600">{errors.content}</div>
        </div>
        <button
          className="ml-auto w-fit rounded-md bg-[#800080] px-2.5 py-1 text-sm font-medium text-white disabled:cursor-not-allowed"
          disabled={processing}
        >
          Create Blog
        </button>
      </form>
    </DashboardLayout>
  )
}
