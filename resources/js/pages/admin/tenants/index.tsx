import { Head, Link } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
import { type BreadcrumbItem } from '@/types'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Button } from '@/components/ui/button'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Tenants',
    href: '/admin/tenants',
  },
]

interface Tenant {
  id: number
  name: string
  slug: string
  domain: string
  created_at: string
}

interface Props {
  tenants: {
    data: Tenant[]
    links: Array<{ url: string | null; label: string; active: boolean }>
  }
}

export default function Tenants({ tenants }: Props) {
  
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Tenants" />
      
      <div className="space-y-4 p-4">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-lg font-medium">Tenant Management</CardTitle>
            <Button asChild>
              <Link href="/admin/tenants/create">Add Tenant</Link>
            </Button>
          </CardHeader>
        </Card>

        <Card>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Name</TableHead>
                  <TableHead>Slug</TableHead>
                  <TableHead>Domain</TableHead>
                  <TableHead>Joined</TableHead>
                  <TableHead className="text-right">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {tenants.data.map((tenant) => (
                  <TableRow key={tenant.id}>
                    <TableCell className="font-medium">{tenant.name}</TableCell>
                    <TableCell>{tenant.slug}</TableCell>
                    <TableCell>{tenant.domain}</TableCell>
                    <TableCell>{tenant.created_at}</TableCell>
                    <TableCell className="text-right space-x-2">
                      <Button variant="outline" size="sm" asChild>
                        <Link href={`/admin/tenants/${tenant.id}/edit`}>Edit</Link>
                      </Button>
                      <Button variant="destructive" size="sm">
                        Delete
                      </Button>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </CardContent>
        </Card>

        <Pagination>
          <PaginationContent>
            {tenants.links.map((link, index) => {
              if (link.url === null) {
                return null
              }

              if (index === 0) {
                return (
                  <PaginationItem key={index}>
                    <PaginationPrevious href={link.url} />
                  </PaginationItem>
                )
              }

              if (index === tenants.links.length - 1) {
                return (
                  <PaginationItem key={index}>
                    <PaginationNext href={link.url} />
                  </PaginationItem>
                )
              }

              return (
                <PaginationItem key={index}>
                  <PaginationLink 
                    href={link.url} 
                    isActive={link.active}
                  >
                    {link.label}
                  </PaginationLink>
                </PaginationItem>
              )
            })}
          </PaginationContent>
        </Pagination>
      </div>
    </AppLayout>
  )
}