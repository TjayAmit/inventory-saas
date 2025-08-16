import { Head, useForm } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
import { type BreadcrumbItem } from '@/types'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Switch } from '@/components/ui/switch'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Tenants',
    href: '/admin/tenants',
  },
  {
    title: 'Create Tenant',
    href: '/admin/tenants/create',
  },
]

interface User {
  id: number
  name: string
  email: string
  created_at: string
  is_admin: boolean
}

interface Props {
  users: User[]
}

export default function CreateTenant({ users }: Props) {
  const { data, setData, post, processing, errors } = useForm({
    name: '',
    slug: '',
    logo: '',
    favicon: '',
    timezone: 'UTC',
    currency: 'USD',
    language: 'en',
    is_active: true,
    user_id: users.length > 0 ? users[0].id.toString() : '',
  })

  const submit = (e: React.FormEvent) => {
    e.preventDefault()
    post('/admin/tenants')
  }

  const handleActiveChange = (checked: boolean) => {
    setData('is_active', checked)
  }

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Create Tenant" />
      
      <div className="space-y-4 p-4">
        <Card>
          <CardHeader>
            <CardTitle className="text-lg font-medium">Create Tenant</CardTitle>
          </CardHeader>
          <CardContent>
            <form onSubmit={submit} className="space-y-4">
              <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <Label htmlFor="name">Name*</Label>
                  <Input
                    id="name"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    error={errors.name}
                  />
                </div>

                <div>
                  <Label htmlFor="slug">Slug*</Label>
                  <Input
                    id="slug"
                    value={data.slug}
                    onChange={(e) => setData('slug', e.target.value)}
                    error={errors.slug}
                  />
                </div>

                <div className="md:col-span-2">
                  <Label htmlFor="user_id">Owner*</Label>
                  <Select
                    value={data.user_id}
                    onValueChange={(value) => setData('user_id', value)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select owner" />
                    </SelectTrigger>
                    <SelectContent>
                      {users.map((user) => (
                        <SelectItem key={user.id} value={user.id.toString()}>
                          {user.name} ({user.email})
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.user_id && (
                    <p className="text-sm text-red-500 mt-1">{errors.user_id}</p>
                  )}
                </div>

                <div>
                  <Label htmlFor="logo">Logo URL</Label>
                  <Input
                    id="logo"
                    value={data.logo}
                    onChange={(e) => setData('logo', e.target.value)}
                    error={errors.logo}
                  />
                </div>

                <div>
                  <Label htmlFor="favicon">Favicon URL</Label>
                  <Input
                    id="favicon"
                    value={data.favicon}
                    onChange={(e) => setData('favicon', e.target.value)}
                    error={errors.favicon}
                  />
                </div>

                <div>
                  <Label htmlFor="timezone">Timezone</Label>
                  <Input
                    id="timezone"
                    value={data.timezone}
                    onChange={(e) => setData('timezone', e.target.value)}
                    error={errors.timezone}
                  />
                </div>

                <div>
                  <Label htmlFor="currency">Currency</Label>
                  <Input
                    id="currency"
                    value={data.currency}
                    onChange={(e) => setData('currency', e.target.value)}
                    error={errors.currency}
                  />
                </div>

                <div>
                  <Label htmlFor="language">Language</Label>
                  <Input
                    id="language"
                    value={data.language}
                    onChange={(e) => setData('language', e.target.value)}
                    error={errors.language}
                  />
                </div>

                <div className="flex items-center space-x-2">
                  <Switch
                    id="is_active"
                    checked={data.is_active}
                    onCheckedChange={handleActiveChange}
                  />
                  <Label htmlFor="is_active">Active Tenant</Label>
                </div>
              </div>

              <Button type="submit" disabled={processing}>
                {processing ? 'Creating...' : 'Create Tenant'}
              </Button>
            </form>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  )
}