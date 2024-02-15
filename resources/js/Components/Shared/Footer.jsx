import { Link } from "@inertiajs/react";

const navigation = {
    genres: [
        { name: "Finding products", href: "Finding products" },
        { name: "Selling products", href: "Selling products" },
        { name: "Orders and shipping", href: "Orders and shipping" },
        { name: "Store design", href: "Store design" },
        { name: "Marketing and conversion", href: "Marketing and conversion" },
        { name: "Store management", href: "Store management" },
    ],
    topics: [
        { name: "Email Marketing", href: "Email Marketing" },
        { name: "Dropshipping", href: "Dropshipping" },
        { name: "Sales channels", href: "Sales channels" },
        { name: "Social proof", href: "Social proof" },
        { name: "Advertising", href: "Advertising" },
    ],
    company: [
        { name: "About", href: "apps.about" },
        { name: "Contacts us", href: "apps.contact" },
    ],
};

export default function Footer() {
    return (
        <footer className="bg-gray-900" aria-labelledby="footer-heading">
            <h2 id="footer-heading" className="sr-only">
                Footer
            </h2>
            <div className="mx-auto max-w-7xl px-6 pb-8 pt-10 sm:pt-10 lg:px-8 lg:pt-10">
                <div className="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div className="flex lg:flex-1 lg:pt-10">
                        <a
                            href="#"
                            className="-m-1.5 p-1.5 flex justify-center items-center "
                        >
                            <img
                                className="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt=""
                            />
                            <span className="ml-3 text-white">
                                Your Company
                            </span>
                        </a>
                    </div>
                    <div className="grid grid-cols-2 gap-8 xl:col-span-2">
                        <div className="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 className="text-sm font-semibold leading-6 text-white">
                                    Application genres
                                </h3>
                                <ul role="list" className="mt-6 space-y-4">
                                    {navigation.genres.map((item) => (
                                        <li key={item.name}>
                                            <a
                                                href={route("category.show",{category:item.href.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})}
                                                className="text-sm leading-6 text-gray-300 hover:text-white"
                                            >
                                                {item.name}
                                            </a>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            <div className="mt-10 md:mt-0">
                                <h3 className="text-sm font-semibold leading-6 text-white">
                                    Trending topics
                                </h3>
                                <ul role="list" className="mt-6 space-y-4">
                                    {navigation.topics.map((item) => (
                                        <li key={item.name}>
                                            <a
                                                  href={route("subcategory.show",{subcategory:item.href.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})}
                                                className="text-sm leading-6 text-gray-300 hover:text-white"
                                            >
                                                {item.name}
                                            </a>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                        <div className="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 className="text-sm font-semibold leading-6 text-white">
                                    Company
                                </h3>
                                <ul role="list" className="mt-6 space-y-4">
                                    {navigation.company.map((item) => (
                                        <li key={item.name}>
                                            <Link
                                                href={route(item.href)}
                                                className="text-sm leading-6 text-gray-300 hover:text-white"
                                            >
                                                {item.name}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    );
}
