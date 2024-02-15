import React, { useState, useEffect } from 'react';
import Section from './Section_Apps.jsx';
import Section1 from "./SectionCategory";
import Buttons from './Buttons';

export default function Main({ apps }) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [mobileFiltersOpen, setMobileFiltersOpen] = useState(false);
  const [app, setApps] = useState([]);
  const [ButtonValue, setButtonValue] = useState('all');
  const appsCategory = [...new Set(apps.map((app) => app.categories))];


  const filterApps = (cat) => {
    const newApp = apps.filter((app) => app.categories === cat);
    setApps(newApp);
    setButtonValue(cat); 
  };

  
  useEffect(() => {
    setButtonValue('all');
  }, []);

  return (
    <div>
      <div>
        <main className="px-20">
          <div>
            <Buttons apps={apps} appsCategory={appsCategory} filterApps={filterApps} setApps={setApps} sendValueButton={setButtonValue} />
          </div>
          {ButtonValue === 'all' ? (
            <section> 
              <Section title={'Finding products'} description={'The Finding Products Shopify app category assists Shopify store owners in streamlining the process of discovering and adding new products to their inventory.'} apps={apps} />
              <Section title={'Selling products'} description={'The Selling Products Shopify app category helps Shopify owners maximize their revenue by optimizing their sales process.'} apps={apps} />
              <Section title={'Orders and shipping'} description={'The Orders and Shipping Shopify app category empowers Shopify merchants to streamline their order management and shipping processes, enhancing efficiency and customer satisfaction.'} apps={apps} />
              <Section title={'Store design'} description={'The Store Design Shopify app category equips Shopify merchants with tools to create visually stunning and user-friendly online storefronts.'} apps={apps} />
              <Section title={'Marketing and conversion'} description={'The Marketing and Conversion Shopify app category empowers merchants to boost their online visibility, attract more visitors, and increase conversions.'} apps={apps} />
              <Section title={'Store management'} description={'The Store Management Shopify app category provides merchants with comprehensive tools to efficiently oversee various aspects of their online business operations.'} apps={apps} />
            </section>
          ) : (
            <Section1  apps={app} />
          )}
        </main>
      </div>
    </div>
  );
}
