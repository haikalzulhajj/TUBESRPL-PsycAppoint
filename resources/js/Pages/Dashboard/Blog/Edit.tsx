import { FormEventHandler } from "react"
import { Head, useForm, usePage } from "@inertiajs/react"

import { CKEditor } from "@ckeditor/ckeditor5-react"
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"

import DashboardLayout from "@/Layouts/Dashboard"
import Input from "@/Components/Input"

import { PageProps } from "@/types"

export default function BlogEdit() {
  const { blog } = usePage<PageProps>().props

  const { setData, post, processing, errors, clearErrors } = useForm<{
    id: string
    title: string
    heading: File | null
    old_heading: string
    content: string
  }>({
    id: blog.id,
    title: blog.title,
    heading: null,
    old_heading: blog.heading,
    content: blog.content
  })

  const submit: FormEventHandler = (e) => {
    e.preventDefault()
    post(route("blog.update"))
  }

  return (
    <DashboardLayout>
      <Head title="Edit Blog" />
      <form
        className="flex flex-col gap-y-2 bg-white px-5 py-4"
        onSubmit={submit}
        autoComplete="off"
      >
        <div className="mb-2 border-b border-b-gray-200 pb-3 text-3xl font-bold">
          Edit Blog
        </div>
        <Input.File
          label="Heading"
          warning="Jika Tidak Ingin Mengubah Gambar Heading, Biarkan Ini Kosong!"
          error={errors.heading}
          change={(e) => {
            setData("heading", e.target.files ? e.target.files[0] : null)
            clearErrors("heading")
          }}
        />
        <Input
          label="Judul"
          type="text"
          value={blog.title}
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
              data={blog.content}
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
          Update Blog
        </button>
      </form>
    </DashboardLayout>
  )
}
