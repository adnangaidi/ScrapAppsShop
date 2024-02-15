import { useState } from "react";
import { Dialog } from "@headlessui/react";
import { Bars3Icon, XMarkIcon } from "@heroicons/react/24/outline";
import { Link } from "@inertiajs/react";
import Search from "../ComponentDefault/Search";
import Dropdown from "./Dropdown.jsx";

const navigation = {
    types: [
        { id: 1, name: "Home", href: "/" },
        { id: 2, name: "Categories", href: "catigorie" },
        { id: 3, name: "About", href: "apps.about" },
        { id: 4, name: "Contact us", href: "apps.contact" },
    ],
    categories: [
        { name: "Finding products", href: "Finding products" },
        { name: "Selling products", href: "Selling products" },
        { name: "Orders and shipping", href: "Orders and shipping" },
        { name: "Store design", href: "Store design" },
        { name: "Marketing and conversion", href: "Marketing and conversion" },
        { name: "Store management", href: "Store management" },
    ],
};

const Header = ({ onSearchResult }) => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    return (
        <header className="sticky top-0 bg-white shadow-md">
            <nav
                className="flex min-w-screen-2xl items-center justify-between gap-x-6 p-6 lg:px-8 "
                aria-label="Global"
            >
                <div className="flex lg:flex-1">
                    <a href="#" className="-m-1.5 p-1.5">
                        <span className="sr-only">Your Company</span>
                        <img
                            className="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                            alt=""
                        />
                    </a>
                </div>

                <div className="hidden lg:flex lg:gap-x-12">
                    {navigation.types.map((item) => (
                        <>
                            {item.name != "Categories" ? (
                                <a
                                    key={item.id}
                                    href={route(item.href)}
                                    className="text-sm font-semibold leading-6 text-gray-900"
                                >
                                    {item.name}
                                </a>
                            ) : (
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                className="inline-flex items-center  border border-transparent text-sm leading-6 font-semibold rounded-md text-gray-900 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {item.name}

                                                <svg
                                                    className="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        {navigation.categories.map(
                                            (category) => (
                                                <Dropdown.Link
                                                    href={route(
                                                        "category.show",
                                                        {
                                                            category:
                                                                category.href.replace(
                                                                    /\/\//g,
                                                                    "-"
                                                                ),
                                                        }
                                                    )}
                                                >
                                                    {category.name}
                                                </Dropdown.Link>
                                            )
                                        )}
                                    </Dropdown.Content>
                                </Dropdown>
                            )}
                        </>
                    ))}
                </div>
                <Search onSearchResult={onSearchResult} />
                <div className="flex lg:hidden">
                    <button
                        type="button"
                        className="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        onClick={() => setMobileMenuOpen(true)}
                    >
                        <span className="sr-only">Open main menu</span>
                        <Bars3Icon className="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
            </nav>
            <Dialog
                as="div"
                className="lg:hidden"
                open={mobileMenuOpen}
                onClose={setMobileMenuOpen}
            >
                <div className="fixed inset-0 z-10" />
                <Dialog.Panel className="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div className="flex items-center gap-x-6">
                        <a href="#" className="-m-1.5 p-1.5">
                            <span className="sr-only">Your Company</span>
                            <img
                                className="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt=""
                            />
                        </a>

                        <button
                            type="button"
                            className="-m-2.5 rounded-md p-2.5 text-gray-700"
                            onClick={() => setMobileMenuOpen(false)}
                        >
                            <span className="sr-only">Close menu</span>
                            <XMarkIcon className="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div className="mt-6 flow-root">
                        <div className="-my-6 divide-y divide-gray-500/10">
                            <div className="space-y-2 py-6">
                                {navigation.types.map((item) => (
                                    <a
                                        key={item.name}
                                        href={item.href}
                                        className="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    >
                                        {item.name}
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>
                </Dialog.Panel>
            </Dialog>
        </header>
    );
};

export default Header;
