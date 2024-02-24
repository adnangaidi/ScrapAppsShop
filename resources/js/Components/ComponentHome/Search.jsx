import { useState, useEffect } from "react";
import {
    ChevronDownIcon,
    MagnifyingGlassIcon,
} from "@heroicons/react/20/solid";
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/react";
export default function Search() {
    const { data, setData, get, processing } = useForm({
        search: "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        get(route("home", data));
    }

    return (
        <div className="mx-auto  w-auto flex flex-1  ">
            <form onSubmit={handleSubmit}>
                <div className="relative flex flex-1">
                    <label htmlFor="search-field" className="sr-only">
                        Search apps
                    </label>
                    <input
                        id="search-field"
                        className="block w-56 bg-gray-50 rounded-xl border-blue-500   pl-8 pr-0 text-gray-900 placeholder:text-gray-400  sm:text-sm"
                        placeholder="Search  apps"
                        type="search"
                        name="search"
                        value={data.search}
                        onChange={(e) => setData("search", e.target.value)}
                    />
                    <button
                        type="submit"
                        className="cursor-pointer mx-2 h-full w-7 mt-1  bg-gray-50 rounded-xl border-blue-500rounded
                    text-gray-900"
                    >
                        <MagnifyingGlassIcon aria-hidden="true" />
                    </button>
                </div>
            </form>
        </div>
    );
}
