import {useState} from 'react'
import AppCard from '../ComponentHome/App_Card'
import Pagination from "./Pagination";

export default function Main({appsCategories}) {
  const [currentPage, setCurrentPage] = useState(1);
  const appsPerPage = 5;
  let totalPages = Math.ceil(appsCategories.length / appsPerPage);

  const nextApps = () => {
    if (currentPage < totalPages) {
      setCurrentPage(prevPage => prevPage + 1);
    }
  };

  const previousApps = () => {
    if (currentPage > 1) {
      setCurrentPage(prevPage => prevPage - 1);
    }
  };
      
  const paginate=(page)=>setCurrentPage(page);
  const endIndex = currentPage * appsPerPage;
  const startIndex = endIndex - appsPerPage;
  const currentApps = appsCategories.slice(startIndex, endIndex);
  return (
    <div>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-6 p-10 ">
      {
          currentApps.length != 0 ? currentApps.map((app,index)=>(
          <>
          <AppCard key={index} slug={app.slug} title={app.name} description={app.description} logo={app.logo} reviews={app.nb_review}  />
          </>
        )) :(
          <div className="h-52 w-full flex justify-center ">
              <div className="text-center ml-20 ">
                  <h2 className="font-semibold text-2xl">No results found</h2>
                  <p className="font-thin text-xl">
                      We can't find anything with that term at the moment,
                      try searching for something else.
                  </p>
              </div>
          </div>
      )
      }
    </div>
    <Pagination currentPage={currentPage} paginate={paginate} totalPages={totalPages} previousApps={previousApps} nextApps={nextApps}/>
    </div>
  )
}
