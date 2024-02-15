import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Main from "../Components/ComponentPageCategory/Main.jsx";
import Pagination from "../Components/ComponentPageCategory/Pagination.jsx";

import SearchPage from "./SearchPage";
 

function PageCategory({apps,appsCategories}) {
  const [searchResult, setSearchResult] = useState('');

    const handleSearchResult = (result) => {
        setSearchResult(result);
      };
  return (
    <>
    <Header onSearchResult={handleSearchResult} apps={apps}/>
    {
        searchResult === '' ? (
            <>
            <Main appsCategories={appsCategories}/>
            {/* <Pagination appsCategories={appsCategories}/> */}
            </>
        ) : (
          <SearchPage result={searchResult} apps={apps}/>
        )
      }
    <Footer/>
    </>
    
  )
}

export default PageCategory;

