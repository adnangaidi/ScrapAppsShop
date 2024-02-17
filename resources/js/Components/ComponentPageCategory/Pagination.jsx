import { useState } from 'react';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/react/20/solid';

function Pagination({ currentPage,paginate,totalPages,previousApps,nextApps }) {
  const PageNumber=[]
  for (let i = 1; i <= totalPages; i++) {
    PageNumber.push(i);
  }


  return (
    <div className="flex justify-center">
      <nav className="flex items-center text-center border-t border-gray-200 px-4 sm:px-0 mb-8">
        <div className="">
          <button
            className="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            onClick={()=>previousApps()}
            disabled={currentPage === 1}
          >
            <ChevronLeftIcon className="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
          </button>
        </div>
        <div className="">
        <div className="flex justify-center">
          {PageNumber.map((numpage) => (
            <div key={numpage}>
                      <a
                      onClick={()=>paginate(numpage)}
          href="#"
          aria-current="page"
          className="inline-flex items-center  border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
        >
          {numpage}
        </a>
            </div>
          ))}
        </div>
        </div>
        <div className="">
          <button
            className="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            onClick={()=>nextApps()}
            disabled={currentPage === totalPages}
          >
            <ChevronRightIcon className="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
          </button>
        </div>
      </nav>
    </div>
  );
}

export default Pagination;
