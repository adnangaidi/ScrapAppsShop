import { useState,useEffect } from 'react'
import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/react/20/solid'
import { Inertia  } from "@inertiajs/inertia";
import { Link } from '@inertiajs/react';
export default function Search({ onSearchResult }) {
  const [search, setSearch] = useState('');

  useEffect(() => {
    const searchTimer = setTimeout(() => {
      onSearchResult(search);
    }, 300); 
    return () => clearTimeout(searchTimer); 
  }, [search, onSearchResult]);

  return (
  
                <div className="mx-auto  w-auto flex flex-1  ">
              <form className="relative flex flex-1" >
                <label htmlFor="search-field" className="sr-only">
                  Search  apps
                </label>
                <input
                  id="search-field"
                  className="block w-56 bg-gray-50 rounded-xl border-blue-500   pl-8 pr-0 text-gray-900 placeholder:text-gray-400  sm:text-sm"
                  placeholder="Search  apps"
                  type="search"
                  name="search"
                  onChange={(e) => setSearch(e.target.value)}
                />
                  {/* <MagnifyingGlassIcon
                  className="pointer-events-none absolute inset-y-0 left-0 h-full w-5 mt-1 text-gray-400"
                  aria-hidden="true"
                /> */}
              </form>
             
            </div>

  )
}
