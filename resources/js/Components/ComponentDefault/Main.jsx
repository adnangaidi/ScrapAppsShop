import { Fragment, useState } from 'react'
import { Dialog, Disclosure, Popover, Tab, Transition } from '@headlessui/react'
import { Bars3Icon, MagnifyingGlassIcon, ShoppingBagIcon, XMarkIcon } from '@heroicons/react/24/outline'
import { ChevronDownIcon, PlusIcon } from '@heroicons/react/20/solid'
import All_Apps from './All_Apps.jsx';


export default function Main({apps,categories}) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
  const [mobileFiltersOpen, setMobileFiltersOpen] = useState(false)

  return (
    <div >
      <div>
        <main className="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
          <div className="pb-10 pt-12 lg:grid lg:grid-cols-3 lg:gap-x-8">
            <section aria-labelledby="product-heading" className="mt-20 lg:col-span-2 mx-auto lg:mt-0 xl:col-span-3">
            
            <All_Apps apps={apps} categories={categories}/>
            </section>
          </div>
        </main>
      </div>
    </div>
  )
}
