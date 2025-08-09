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
import { Badge } from '@/components/ui/badge'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from '@/components/ui/pagination'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Admin',
    href: '/admin',
  },
  {
    title: 'Users',
    href: '/admin/users',
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
  users: {
    data: User[]
    links: Array<{ url: string | null; label: string; active: boolean }>
  }
}

export default function Users({ users }: Props) {
  console.log('All props:', users);
  
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Users" />
      
      <div className="space-y-4">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-lg font-medium">User Management</CardTitle>
            <Button asChild>
              <Link href="/admin/users/create">Add User</Link>
            </Button>
          </CardHeader>
        </Card>

        <Card>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Name</TableHead>
                  <TableHead>Email</TableHead>
                  <TableHead>Role</TableHead>
                  <TableHead>Joined</TableHead>
                  <TableHead className="text-right">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {users.data.map((user) => (
                  <TableRow key={user.id}>
                    <TableCell className="font-medium">{user.name}</TableCell>
                    <TableCell>{user.email}</TableCell>
                    <TableCell>
                      <Badge variant={user.is_admin ? 'default' : 'secondary'}>
                        {user.is_admin ? 'Admin' : 'User'}
                      </Badge>
                    </TableCell>
                    <TableCell>{user.created_at}</TableCell>
                    <TableCell className="text-right space-x-2">
                      <Button variant="outline" size="sm" asChild>
                        <Link href={`/admin/users/${user.id}/edit`}>Edit</Link>
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
            {users.links.map((link, index) => {
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

              if (index === users.links.length - 1) {
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