export interface User {
  id: string
  name: string
  email: string
  address: string
  phone_number: string
  avatar: string
  service: string
  role: string
  points: number
  created_at: string
}

export interface Coupon {
  id: string
  coupon: string
  code: string
}

export interface Specialist {
  id: string
  name: string
  service: string
  avatar: string
}

export interface Appointment {
  id: string
  requester_id: string
  requester_name: string
  requester_avatar: string
  specialist_id: string
  specialist_name: string
  specialist_avatar: string
  time: string
  address: string
  service: string
  message: string
  response: string
  payment: string
  status: string
  review: string
  feedback: string
  completed: 0 | 1
}

export interface Blog {
  id: string
  slug: string
  title: string
  heading: string
  preview: string
  content: string
  creator: string
  avatar: string
  status: string
  created_at: string
}

export interface Journal {
  id: string
  slug: string
  title: string
  preview: string
  content: string
  creator: string
  avatar: string
  created_at: string
}

export interface Pagination {
  from: number
  to: number
  total: number
  current_page: number
  last_page: number
  first_page_url: string
  last_page_url: string
  links: {
    url: string | null,
    label: string
    active: boolean
  }[]
  path: string
  per_page: number
  next_page_url: string | null
  prev_page_url: string | null
}

export interface Users extends Pagination {
  data: User[]
}

export interface Appointments extends Pagination {
  data: Appointment[]
}

export interface Blogs extends Pagination {
  data: Blog[]
}

export interface Journals extends Pagination {
  data: Journal[]
}

export interface Coupons extends Pagination {
  data: Coupon[]
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  auth: {
    user: User
  }
  token: string
  status: string
  users: Users
  user: User
  specialists: Specialist[]
  appointment: Appointment
  appointments: Appointments
  blog: Blog
  blogs: Blogs
  journal: Journal
  journals: Journals
  coupons: Coupons
}
