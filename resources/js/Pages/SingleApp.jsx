import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Container from "../Components/ComSingle/Container.jsx";

import PropTypes from "prop-types";

const SingleApp = ({auth,app,categorie,description,role,price,url}) => {
  return (
       <>
            <Header auth={auth}/>
            <Container app={app} categorie={categorie} description={description} role={role} price={price} url={url}/>
            <Footer />
        </>
  );
}
SingleApp.propTypes = {
  auth: PropTypes.oneOfType([PropTypes.object, PropTypes.array]).isRequired,
};
export default SingleApp;
