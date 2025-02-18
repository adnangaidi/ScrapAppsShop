import React, { useEffect } from "react";
import { Link } from "@inertiajs/react";

export default function App_info({ app, categorie, url }) {
    return (
        <div className="mx-4 md:mx-36 lg:mx-36 flex justify-between items-center">
            <div className="mb-4 md:mb-0 inline-grid rounded-md shadow-sm">
                <div className="flex items-start">
                    <div className="mr-4 flex-shrink-0">
                        <img
                            className="h-16 w-16 border border-gray-300  text-gray-300"
                            src={app.logo}
                            alt=""
                        />
                    </div>
                    <div className="max-w-xs md:max-w-2xl">
                        <h3 className="text-lg font-bold">{app.name}</h3>
                        <p className="text-lg font-semibold">
                        Developer:
                        <Link href={route("developer.show",{developer:app.developer.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})} className="underline decoration-2 hover:no-underline hover:text-blue-500">{app.developer}</Link>
                        </p>
                        <p className="mt-1">
                            {app.nb_review} <span>reviews</span>
                        </p>
                    </div>
                </div>
                <div className="mt-4">
                    <ul className="flex justify-around">
                                <li
                                    className="mx-2 md:mx-4 px-2 md:px-4 py-1 cursor-pointer hover:bg-gray-300 h-8 md:h-10 w-auto self-center rounded-xl font-semibold text-sm md:text-base"
                                >
                                    <Link href={route("category.show",{category:app.categories.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})}>{app.categories}</Link>
                                </li>
                                <li
                                    className="mx-2 md:mx-4 px-2 md:px-4 py-1 cursor-pointer hover:bg-gray-300 h-8 md:h-10 w-auto self-center rounded-xl font-semibold text-sm md:text-base"
                                >
                                    <Link href={route("subcategory.show",{subcategory:app.subcategories.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})}>{app.subcategories}</Link>
                                </li>
                                {
                                    app.subcategories1 != null?(
                                        <li

                                    className="mx-2 md:mx-4 px-2 md:px-4 py-1 cursor-pointer hover:bg-gray-300 h-8 md:h-10 w-auto self-center rounded-xl font-semibold text-sm md:text-base"
                                >
                                    <Link href={route("subcategory.show",{subcategory:app.subcategories1.replace(
                                                    /\/\//g,
                                                    "-"
                                                )})}>{app.subcategories1}</Link>
                                </li>
                                    ):''
                                }
                            {/* ) : null
                        )} */}
                    </ul>
                </div>
            </div>
            <div className="mt-4 md:mt-0 justify-self-end">
                <a
                    target="_blank" // Note: This may not work as expected in React Router
                    rel="noopener noreferrer"
                    href={url[0]["url"]}
                    className="rounded-full bg-[#8f54c2] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Install App
                </a>
            </div>
        </div>
    );
}
