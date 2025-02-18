import { BuildingOffice2Icon, EnvelopeIcon, PhoneIcon } from '@heroicons/react/24/outline';
import { useState, useEffect } from 'react';
import InputError from '@/Components/Shared/InputError';
import InputLabel from '@/Components/Shared/InputLabel';
import PrimaryButton from '@/Components/Shared/PrimaryButton';
import TextInput from '@/Components/Shared/TextInput';
import TextAreaLabel from '@/Components/Shared/Textarea';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

function Contact({ status }) {
  const [visible, setVisible] = useState(false);
  const { data, setData, post, processing } = useForm({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    message: '',
  });

  const { flash,errors } = usePage().props;

  const submit = (e) => {
      e.preventDefault();
      post(route('contact.post'), {
        onSuccess: () => {
          setData({
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            message: '',
          });
          setVisible(true)
        },
      });
    };


  useEffect(() => {
    const timer = setTimeout(() => {
      setVisible(false);
    }, 5000);
  
    return () => clearTimeout(timer);
  }, [visible]);

  return (
    <div className="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
      <div className="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
        <div className="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
          <div className="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">
            <svg
              className="absolute inset-0 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
              aria-hidden="true"
            >
              <defs>
                <pattern
                  id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527"
                  width={200}
                  height={200}
                  x="100%"
                  y={-1}
                  patternUnits="userSpaceOnUse"
                >
                  <path d="M130 200V.5M.5 .5H200" fill="none" />
                </pattern>
              </defs>
              <rect width="100%" height="100%" strokeWidth={0} fill="white" />
              <svg x="100%" y={-1} className="overflow-visible fill-gray-50">
                <path d="M-470.5 0h201v201h-201Z" strokeWidth={0} />
              </svg>
              <rect width="100%" height="100%" strokeWidth={0} fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
            </svg>
          </div>
          <h2 className="text-3xl font-bold tracking-tight text-gray-900">Get in touch</h2>
          <p className="mt-6 text-lg leading-8 text-gray-600">
            Proin volutpat consequat porttitor cras nullam gravida at. Orci molestie a eu arcu. Sed ut tincidunt
            integer elementum id sem. Arcu sed malesuada et magna.
          </p>
          <dl className="mt-10 space-y-4 text-base leading-7 text-gray-600">
            <div className="flex gap-x-4">
              <dt className="flex-none">
                <span className="sr-only">Address</span>
                <BuildingOffice2Icon className="h-7 w-6 text-gray-400" aria-hidden="true" />
              </dt>
              <dd>
                545 Mavis Island
                <br />
                Chicago, IL 99191
              </dd>
            </div>
            <div className="flex gap-x-4">
              <dt className="flex-none">
                <span className="sr-only">Telephone</span>
                <PhoneIcon className="h-7 w-6 text-gray-400" aria-hidden="true" />
              </dt>
              <dd>
                <a className="hover:text-gray-900" href="tel:+1 (555) 234-5678">
                  +1 (555) 234-5678
                </a>
              </dd>
            </div>
            <div className="flex gap-x-4">
              <dt className="flex-none">
                <span className="sr-only">Email</span>
                <EnvelopeIcon className="h-7 w-6 text-gray-400" aria-hidden="true" />
              </dt>
              <dd>
                <a className="hover:text-gray-900" href="mailto:hello@example.com">
                  hello@example.com
                </a>
              </dd>
            </div>
          </dl>
        </div>
      </div>
      <form onSubmit={submit} className="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
        <div className="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
            <div className="pb-2">
            {visible && (
              <div className="bg-blue-500 text-white font-bold py-2 px-4 rounded">{flash.message}</div>
            )}
          </div>
          <div className="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div>
              <InputLabel htmlFor="first name" value="First Name" className="block text-sm font-semibold leading-6 text-gray-900" />
              <div className="mt-2.5">
                <TextInput
                  id="first-name"
                  name="first-name"
                  value={data.firstName}
                  className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  autoComplete="first Name"
                  isFocused={true}
                  onChange={(e) => setData('firstName', e.target.value)}
                  required
                />
                <InputError message={errors.firstName} className="mt-2" />
              </div>
            </div>
            <div>
              <InputLabel htmlFor="last name" value="Last Name" className="block text-sm font-semibold leading-6 text-gray-900" />
              <div className="mt-2.5">
                <TextInput
                  id="last-name"
                  name="last-name"
                  value={data.lastName}
                  className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  autoComplete="last Name"
                  isFocused={true}
                  onChange={(e) => setData('lastName', e.target.value)}
                  required
                />
                <InputError message={errors.lastName} className="mt-2" />
              </div>
            </div>
            <div className="sm:col-span-2">
              <InputLabel htmlFor="email" value="email" className="block text-sm font-semibold leading-6 text-gray-900" />
              <div className="mt-2.5">
                <TextInput
                  id="email"
                  name="email"
                  type="email"
                  value={data.email}
                  className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  autoComplete="email"
                  isFocused={true}
                  onChange={(e) => setData('email', e.target.value)}
                  required
                />
                <InputError message={errors.email} className="mt-2" />
              </div>
            </div>
            <div className="sm:col-span-2">
              <InputLabel htmlFor="phone" value="phone Number" className="block text-sm font-semibold leading-6 text-gray-900" />
              <div className="mt-2.5">
                <TextInput
                  id="phone"
                  name="phone"
                  value={data.phone}
                  className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  autoComplete="first Name"
                  isFocused={true}
                  onChange={(e) => setData('phone', e.target.value)}
                  required
                />
                <InputError message={errors.phone} className="mt-2" />
              </div>
            </div>
            <div className="sm:col-span-2">
              <InputLabel htmlFor="message" value="Message" className="block text-sm font-semibold leading-6 text-gray-900" />
              <div className="mt-2.5">
                <textarea
                  name="message"
                  id="message"
                  rows={4}
                  className="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  value={data.message}
                  isFocused={true}
                  onChange={(e) => setData('message', e.target.value)}
                  required
                />
                <InputError message={errors.message} className="mt-2" />
              </div>
            </div>
          </div>
          <div className="mt-8 flex justify-end">
            <PrimaryButton disabled={processing} type="submit">
              Send message
            </PrimaryButton>
          </div>
        </div>
      </form>
    </div>
  );
}

export default Contact;
