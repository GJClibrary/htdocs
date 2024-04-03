import { ChevronDownIcon } from "@radix-ui/react-icons";

import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar";
import { Button } from '@/components/ui/button';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
} from "@/components/ui/command";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";

interface TeamMember {
  id: number;
  name: string;
  email: string;
  avatarSrc: string;
  avatarFallbackBg: string;
  role: string;
}

const teamMembersData: TeamMember[] = [
    {
      id: 1,
      name: "Ali Medina",
      email: "alimedina@gjc.com",
      avatarSrc: "/avatars/01.png",
      avatarFallbackBg: "bg-blue-500",
      role: "Professor"
    },
    {
      id: 2,
      name: "Jethro Mabeza",
      email: "j3thromabeza@gmail.com",
      avatarSrc: "/avatars/08.png",
      avatarFallbackBg: "bg-fuchsia-500",
      role: "Member"
    },
    {
      id: 3,
      name: "Janzen De Asis",
      email: "paiZen@gmail.com",
      avatarSrc: "/avatars/09.png",
      avatarFallbackBg: "bg-emerald-200",
      role: "Member"
    },
    {
      id: 4,
      name: "Miguel Macabagdal",
      email: "miguel@alternative.com",
      avatarSrc: "/avatars/03.png",
      avatarFallbackBg: "bg-violet-700",
      role: "Member"
    },
    {
      id: 5,
      name: "Melvin Nogoy",
      email: "m.viner001@gmail.com",
      avatarSrc: "/avatars/04.png",
      avatarFallbackBg: "bg-lime-300",
      role: "Member"
    },
    {
      id: 6,
      name: "John Esternon",
      email: "john.esternon@alt.com",
      avatarSrc: "/avatars/06.png",
      avatarFallbackBg: "bg-yellow-500",
      role: "Member"
    },
  ];
  

  export function DemoTeamMembers() {
  
    return (
      <Card>
        <CardHeader>
          <CardTitle>Team Members</CardTitle>
          <CardDescription>
            Invite your team members to collaborate.
          </CardDescription>
        </CardHeader>
        <CardContent className="grid gap-6">
          {teamMembersData.map((member) => (
            <div key={member.id} className="flex items-center justify-between space-x-4">
              <div className="flex items-center space-x-4">
                <Avatar>
                  <AvatarImage src={member.avatarSrc} />
                  <AvatarFallback className={member.avatarFallbackBg}>
                    {member.name.substring(0, 2).toUpperCase()}
                  </AvatarFallback>
                </Avatar>
                <div>
                  <p className="text-sm font-medium leading-none">{member.name}</p>
                  <p className="text-sm text-muted-foreground">{member.email}</p>
                </div>
              </div>
              <Popover>
                <PopoverTrigger asChild>
                  {member.role === "Professor" ? (
                    <Button
                      className="ml-auto bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    >
                      {member.role}{" "}
                      <ChevronDownIcon className="ml-2 h-4 w-4 text-muted-foreground" />
                    </Button>
                  ) : (
                    <Button
                      className="ml-auto"
                      variant="outline"
                    >
                      {member.role || "Member"}{" "}
                      <ChevronDownIcon className="ml-2 h-4 w-4 text-muted-foreground" />
                    </Button>
                  )}
                </PopoverTrigger>
                <PopoverContent className="p-0" align="end">
                  <Command>
                    <CommandInput placeholder="Select new role..." />
                    <CommandList>
                      <CommandEmpty>No roles found.</CommandEmpty>
                      <CommandGroup className="p-1.5">
                        <CommandItem
                          onClick={() => ("Viewer")}
                          className="teamaspace-y-1 flex flex-col items-start px-4 py-2"
                        >
                          <p>Viewer</p>
                          <p className="text-sm text-muted-foreground">
                            Can view and comment.
                          </p>
                        </CommandItem>
                        {/* Add other roles here */}
                      </CommandGroup>
                    </CommandList>
                  </Command>
                </PopoverContent>
              </Popover>
            </div>
          ))}
        </CardContent>
      </Card>
    );
  }
  
