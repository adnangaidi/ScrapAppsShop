import { useState } from 'react'
import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/react/20/solid'

export default function Search() {
  


  return (
    <>   
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
                />
              </form>
            </div>
    </>
  )
}
