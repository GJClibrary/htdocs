
import {
    Menubar,
    MenubarContent,
    MenubarItem,
    MenubarLabel,
    MenubarMenu,
    MenubarRadioGroup,
    MenubarRadioItem,
    MenubarSeparator,
    MenubarShortcut,
    MenubarSub,
    MenubarSubContent,
    MenubarSubTrigger,
    MenubarTrigger,
  } from "@/components/ui/menubar"

import { Search } from "@/components/search"
import { UserNav } from "@/components/user-nav"
import { ModeToggle } from "./mode-toggle"

export default function Navbar() {
    return (
      <>
        
        <div className="hidden flex-col md:flex">
          <div className="">
            <div className="flex h-16 items-center px-4">
            <Menubar className="rounded-none border-b border-none px-2 lg:px-4">
        <MenubarMenu>
          <MenubarTrigger className="font-bold"><a href="https://gjclibrary.great-site.net/" target="_blank">
                {/* <img src={gjcLogo} className="logo react h-9 mr-2" alt="GJC Library logo" /> */}
              </a>Home</MenubarTrigger>
          <MenubarContent>
            <MenubarItem>About GJC Library System</MenubarItem>
            <MenubarSeparator />
            <MenubarItem>
              Team <MenubarShortcut>⌘,</MenubarShortcut>
            </MenubarItem>
            <MenubarSeparator />
            <MenubarItem>
              Blogs <MenubarShortcut>⌘H</MenubarShortcut>
            </MenubarItem>
            <MenubarItem>
              Services <MenubarShortcut>⇧⌘H</MenubarShortcut>
            </MenubarItem>
            <MenubarShortcut />
            <MenubarItem>
              Book Gallery <MenubarShortcut>⌘Q-</MenubarShortcut>
            </MenubarItem>
          </MenubarContent>
        </MenubarMenu>
        <MenubarMenu>
          <MenubarTrigger className="relative">Book</MenubarTrigger>
          <MenubarContent>
            <MenubarSub>
              <MenubarSubTrigger>New</MenubarSubTrigger>
              <MenubarSubContent className="w-[230px]">
                <MenubarItem>
                  Notes <MenubarShortcut>⌘N</MenubarShortcut>
                </MenubarItem>
                <MenubarItem disabled>
                  Booklist from Other Students <MenubarShortcut>⇧⌘N</MenubarShortcut>
                </MenubarItem>
                <MenubarItem>
                  Smart Booklist... <MenubarShortcut>⌥⌘N</MenubarShortcut>
                </MenubarItem>
                <MenubarItem>Booklist Folder</MenubarItem>
                <MenubarItem disabled>Recommended Books</MenubarItem>
              </MenubarSubContent>
            </MenubarSub>
            
            <MenubarSeparator />
            <MenubarSub>
              <MenubarSubTrigger>Borrowed</MenubarSubTrigger>
              <MenubarSubContent>
                <MenubarItem>View My Borrowed Books</MenubarItem>
                <MenubarSeparator />
                <MenubarItem>Organize My Books</MenubarItem>
                <MenubarItem>Export Notes</MenubarItem>
                <MenubarSeparator />
                <MenubarItem>Import Notes from Txt</MenubarItem>
                <MenubarItem>Show Incoming Due Dates</MenubarItem>
                <MenubarSeparator />
                <MenubarItem>Get Reservation for Books</MenubarItem>
                <MenubarItem disabled>Return Now</MenubarItem>
              </MenubarSubContent>
            </MenubarSub>
            <MenubarSeparator />
            <MenubarItem>
              Penalties <MenubarShortcut>⇧⌘R</MenubarShortcut>{" "}
            </MenubarItem>
            <MenubarItem>Return Now</MenubarItem>
            <MenubarSeparator />
            <MenubarItem>Book Gallery Setup...</MenubarItem>
            <MenubarItem disabled>
              Return Now <MenubarShortcut>⌘P</MenubarShortcut>
            </MenubarItem>
          </MenubarContent>
        </MenubarMenu>
        <MenubarMenu>
          <MenubarTrigger>Reservation</MenubarTrigger>
          <MenubarContent>
            <MenubarItem disabled>
              Undo <MenubarShortcut>⌘Z</MenubarShortcut>
            </MenubarItem>
            <MenubarItem disabled>
              Redo <MenubarShortcut>⇧⌘Z</MenubarShortcut>
            </MenubarItem>
            <MenubarSeparator />
            <MenubarItem disabled>
              Delete <MenubarShortcut>⌘X</MenubarShortcut>
            </MenubarItem>
            <MenubarItem disabled>
              Cancel <MenubarShortcut>⌘C</MenubarShortcut>
            </MenubarItem>
            <MenubarSeparator />
            <MenubarItem>
              View Book Reservation{" "}
              <MenubarShortcut>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  stroke="currentColor"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  className="h-4 w-4"
                  viewBox="0 0 24 24"
                >
                  <path d="m12 8-9.04 9.06a2.82 2.82 0 1 0 3.98 3.98L16 12" />
                  <circle cx="17" cy="7" r="5" />
                </svg>
              </MenubarShortcut>
            </MenubarItem>
            <MenubarItem>
              Add More{" "}
              <MenubarShortcut>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  stroke="currentColor"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  className="h-4 w-4"
                  viewBox="0 0 24 24"
                >
                  <circle cx="12" cy="12" r="10" />
                  <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                </svg>
              </MenubarShortcut>
            </MenubarItem>
          </MenubarContent>
        </MenubarMenu>
        
        <MenubarMenu>
          <MenubarTrigger className="hidden md:block">Account</MenubarTrigger>
          <MenubarContent forceMount>
            <MenubarLabel inset>Switch Account</MenubarLabel>
            <MenubarSeparator />
            <MenubarRadioGroup value="benoit">
              <MenubarRadioItem value="andy">Andy</MenubarRadioItem>
              <MenubarRadioItem value="benoit">Benoit</MenubarRadioItem>
              <MenubarRadioItem value="Luis">Luis</MenubarRadioItem>
            </MenubarRadioGroup>
            <MenubarSeparator />
            <MenubarItem inset>Manage Penalties</MenubarItem>
            <MenubarSeparator />
            <a href="signout.php"><MenubarItem inset>Logout</MenubarItem></a>
          </MenubarContent>
        </MenubarMenu>
      </Menubar>

      <a href="https://gjclibrary.great-site.net/" className='font-bold text-sm text-slate-300'>Team</a>
              <div className="ml-auto flex items-center space-x-4">
                <Search />
                <ModeToggle />
                <UserNav />
              </div>
            </div>
          </div>
          
        </div>
      </>
    )
  }