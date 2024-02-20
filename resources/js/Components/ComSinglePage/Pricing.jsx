import React from 'react'
import { CheckCircleIcon } from '@heroicons/react/20/solid'

export default function Pricing({ price }) {
  return (
    <div className="py-10 sm:py-1  mb-3 ">
      <div className="mx-auto max-w-7xl px-6 lg:px-8">
        <div className="mx-auto max-w-4xl sm:text-center">
          <h2 className="font-semibold leading-7 text-indigo-600 text-2xl">Pricing</h2>
        </div>

        <div className="mt-20 flow-root">
  <div className="-mt-16 grid max-w-sm grid-cols-1 gap-y-16 divide-y sm:mx-auto lg:-mx-8 lg:mt-0 lg:max-w-none lg:grid-cols-3 lg:divide-x lg:divide-y-0 xl:-mx-4">
    {price && price.map((tier,index) => (
      <div key={index} className="pt-16 lg:px-8 lg:pt-0 xl:px-14">
        <h3 className="text-base font-semibold leading-7 text-gray-900">
          {tier.name}
        </h3>
        <p className="mt-6 flex items-baseline gap-x-1">
          <span className="text-3xl font-bold tracking-tight text-gray-900">{tier.price}</span>
          <span className="text-sm font-semibold leading-6 text-gray-600">/month</span>
        </p>
        <p className="mt-10 text-sm font-semibold leading-6 text-gray-900">{tier.description}</p>
        {tier.plan && (
          <ul role="list" className="mt-6 space-y-3 text-sm leading-6 text-gray-600">
            {tier.plan.map((feature, index) => (
              <li key={index} className="flex gap-x-3">
                <CheckCircleIcon className="h-6 w-5 flex-none text-green-600" aria-hidden="true" />
                {feature}
              </li>
            ))}
          </ul>
        )}
      </div>
    ))}
  </div>
</div>

      </div>
    </div>
  );
}
