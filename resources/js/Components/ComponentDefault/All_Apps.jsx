import React, { Fragment, useState, useEffect } from "react";
import {Dialog,Disclosure,Menu,Popover,Tab,Transition} from "@headlessui/react";
import { XMarkIcon } from "@heroicons/react/24/outline";
import { ChevronDownIcon, StarIcon,MagnifyingGlassIcon } from "@heroicons/react/20/solid";
import { Inertia  } from "@inertiajs/inertia";
import { Link } from '@inertiajs/react';



export default function All_Apps({apps,categories}) {
    const[data]=useState(Object.keys(categories));
    const[search,setSearch]=useState('');
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [mobileFiltersOpen, setMobileFiltersOpen] = useState(false);

    function findApp(search, infoApps){
        return infoApps.filter((app)=>{
          return search.toLowerCase()==='' ? app: app.name.toLowerCase().includes(search);
        })
    }
console.log(search)
    const categoryOptions = data
        ? data.map((key) => ({
              label: categories[key],
              value: categories[key],
          }))
        : [];

    const info_apps = apps
        ? apps.map((app) => ({
              id: app["app_id"],
              name: app["name"],
              href: `/${app["app_id"]}`,
              num_review: app["nb_review"],
              description: "this is just test of our application",
              imageSrc: app["logo"],
          }))
        : [];

        const filteredApps = findApp(search, info_apps);
    const filters = [
        {
            id: "category",
            name: "Category",
            options: categoryOptions,
        },
    ];
    return (
        <div className="bg-gray-50 mx-auto">
                  <div className="mx-auto md:h-20 md:w-1/2 mb-10 flex flex-1  ">
              <form className="relative flex flex-1" action="#" method="GET">
                <label htmlFor="search-field" className="sr-only">
                  Search for shopify apps
                </label>
                <MagnifyingGlassIcon
                  className="pointer-events-none absolute inset-y-0 left-0 h-full w-5 mt-1 text-gray-400"
                  aria-hidden="true"
                />
                <input
                  id="search-field"
                  className="block h-12 bg-gray-50 rounded-xl border-blue-500 w-full mt-5 pl-8 pr-0 text-gray-900 placeholder:text-gray-400  sm:text-sm"
                  placeholder="Search for shopify apps"
                  type="search"
                  name="search"
                  onChange={(e)=>setSearch(e.target.value)}
                />
              </form>
            </div>

            <div>
                {/* Mobile filter dialog */}
                <Transition.Root show={mobileFiltersOpen} as={Fragment}>
                    <Dialog
                        as="div"
                        className="relative z-40 sm:hidden"
                        onClose={setMobileFiltersOpen}
                    >
                        <Transition.Child
                            as={Fragment}
                            enter="transition-opacity ease-linear duration-300"
                            enterFrom="opacity-0"
                            enterTo="opacity-100"
                            leave="transition-opacity ease-linear duration-300"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <div className="fixed inset-0 bg-black bg-opacity-25" />
                        </Transition.Child>

                        <div className="fixed inset-0 z-40 flex">
                            <Transition.Child
                                as={Fragment}
                                enter="transition ease-in-out duration-300 transform"
                                enterFrom="translate-x-full"
                                enterTo="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leaveFrom="translate-x-0"
                                leaveTo="translate-x-full"
                            >
                                <Dialog.Panel className="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-6 shadow-xl">
                                    <div className="flex items-center justify-between px-4">
                                        <h2 className="text-lg font-medium text-gray-900">
                                            Filters
                                        </h2>
                                        <button
                                            type="button"
                                            className="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            onClick={() =>
                                                setMobileFiltersOpen(false)
                                            }
                                        >
                                            <span className="sr-only">
                                                Close menu
                                            </span>
                                            <XMarkIcon
                                                className="h-6 w-6"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>

                                    {/* Filters */}
                                    <form className="mt-4">
                                        {filters.map((section) => (
                                            <Disclosure
                                                as="div"
                                                key={section.name}
                                                className="border-t border-gray-200 px-4 py-6"
                                            >
                                                {({ open }) => (
                                                    <>
                                                        <h3 className="-mx-2 -my-3 flow-root">
                                                            <Disclosure.Button className="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400">
                                                                <span className="font-medium text-gray-900">
                                                                    {
                                                                        section.name
                                                                    }
                                                                </span>
                                                                <span className="ml-6 flex items-center">
                                                                    <ChevronDownIcon
                                                                        className={
                                                                            (open
                                                                                ? "-rotate-180"
                                                                                : "rotate-0",
                                                                            "h-5 w-5 transform")
                                                                        }
                                                                        aria-hidden="true"
                                                                    />
                                                                </span>
                                                            </Disclosure.Button>
                                                        </h3>
                                                        <Disclosure.Panel className="pt-6">
                                                            <div className="space-y-6">
                                                                {section.options.map(
                                                                    (
                                                                        option,
                                                                        optionIdx
                                                                    ) => (
                                                                        <div
                                                                            key={
                                                                                option.value
                                                                            }
                                                                            className="flex items-center"
                                                                        >
                                                                            <input
                                                                                id={`filter-mobile-${section.id}-${optionIdx}`}
                                                                                name={`${section.id}[]`}
                                                                                defaultValue={
                                                                                    option.value
                                                                                }
                                                                                type="checkbox"
                                                                                defaultChecked={
                                                                                    option.checked
                                                                                }
                                                                                className="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                                            />
                                                                            <label
                                                                                htmlFor={`filter-mobile-${section.id}-${optionIdx}`}
                                                                                className="ml-3 text-sm text-gray-500"
                                                                            >
                                                                                {
                                                                                    option.label
                                                                                }
                                                                            </label>
                                                                        </div>
                                                                    )
                                                                )}
                                                            </div>
                                                        </Disclosure.Panel>
                                                    </>
                                                )}
                                            </Disclosure>
                                        ))}
                                    </form>
                                </Dialog.Panel>
                            </Transition.Child>
                        </div>
                    </Dialog>
                </Transition.Root>

                
                    <div className="max-w-screen-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                        {/* Filters */}
                        <section
                            aria-labelledby="filter-heading"
                            className="border-t border-gray-200 pt-6"
                        >
                            <h2 id="filter-heading" className="sr-only">
                                Apps filter
                            </h2>

                            <div className="flex items-center justify-between">
                                <Menu
                                    as="div"
                                    className="relative inline-block text-left"
                                >
                                    <Transition
                                        as={Fragment}
                                        enter="transition ease-out duration-100"
                                        enterFrom="transform opacity-0 scale-95"
                                        enterTo="transform opacity-100 scale-100"
                                        leave="transition ease-in duration-75"
                                        leaveFrom="transform opacity-100 scale-100"
                                        leaveTo="transform opacity-0 scale-95"
                                    ></Transition>
                                </Menu>

                                <button
                                    type="button"
                                    className="inline-block text-sm font-medium text-gray-700 hover:text-gray-900 sm:hidden"
                                    onClick={() => setMobileFiltersOpen(true)}
                                >
                                    Filters
                                </button>

                                <Popover.Group className="hidden sm:flex sm:items-baseline sm:space-x-8">
                                    {filters.map((section, sectionIdx) => (
                                        <Popover
                                            as="div"
                                            key={section.name}
                                            id="menu"
                                            className="relative inline-block text-left"
                                        >
                                            <div>
                                                <Popover.Button className="group inline-flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                                    <span>{section.name}</span>
                                                    {sectionIdx === 0 ? (
                                                        <span className="ml-1.5 rounded bg-gray-200 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700">
                                                            1
                                                        </span>
                                                    ) : null}
                                                    <ChevronDownIcon
                                                        className="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                        aria-hidden="true"
                                                    />
                                                </Popover.Button>
                                            </div>

                                            <Transition
                                                as={Fragment}
                                                enter="transition ease-out duration-100"
                                                enterFrom="transform opacity-0 scale-95"
                                                enterTo="transform opacity-100 scale-100"
                                                leave="transition ease-in duration-75"
                                                leaveFrom="transform opacity-100 scale-100"
                                                leaveTo="transform opacity-0 scale-95"
                                            >
                                                <Popover.Panel className="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <form className="space-y-4">
                                                        {section.options.map(
                                                            (
                                                                option,
                                                                optionIdx
                                                            ) => (
                                                                <div
                                                                    key={
                                                                        option.value
                                                                    }
                                                                    className="flex items-center"
                                                                >
                                                                    <input
                                                                        id={`filter-${section.id}-${optionIdx}`}
                                                                        name={`${section.id}[]`}
                                                                        defaultValue={
                                                                            option.value
                                                                        }
                                                                        defaultChecked={
                                                                            option.checked
                                                                        }
                                                                        type="checkbox"
                                                                        className="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                                    />
                                                                    <label
                                                                        htmlFor={`filter-${section.id}-${optionIdx}`}
                                                                        className="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900"
                                                                    >
                                                                        {
                                                                            option.label
                                                                        }
                                                                    </label>
                                                                </div>
                                                            )
                                                        )}
                                                    </form>
                                                </Popover.Panel>
                                            </Transition>
                                        </Popover>
                                    ))}
                                </Popover.Group>
                            </div>
                        </section>

                        {/* Product grid */}
                        <section
                            aria-labelledby="products-heading"
                            className="mt-8"
                        >
                            <h2 id="products-heading" className="sr-only">
                                Apps
                            </h2>

                            <div className="grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 ">
                                {filteredApps.map((app) => (
                                    <Link
                                        key={app.id}
                                        href={app.href}
                                        className=" hover:bg-gray-200 p-4 rounded-xl items-center w-auto"
                                    >
                                        <div className="flex md:flex-row ">
                                            <img
                                                src={app.imageSrc}
                                                alt=""
                                                className="h-[72px] mx-5 rounded"
                                            />
                                            <div className=" grid-cols-1  items-center justify-between text-base font-medium text-gray-900">
                                                <h3 className="font-bold">
                                                    {app.name}
                                                </h3>
                                                <p>{app.num_review} reviews</p>
                                                
                                            </div>
                                        </div>
                                        <p className="mt-2 text-sm  text-gray-600">
                                            {app.description}
                                        </p>
                                    </Link>
                                ))}
                            </div>
                        </section>
                    </div>

            </div>
        </div>
    );
}
   
function findapp(app){
    return filter((app)=>{
      return search.toLowerCase()==='' ? app: app.name.toLowerCase().includes(search);
    })
}