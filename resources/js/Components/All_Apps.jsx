import { EnvelopeIcon, PhoneIcon } from "@heroicons/react/20/solid";

const apps = [
    {
        id: 1,
        name: "Postscript SMS Marketing",
        discription:
            "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
        logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
        url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
    },
    {
      id: 2,
      name: "Postscript SMS Marketing",
      discription:
          "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
      logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
      url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
  },
  {
    id: 3,
    name: "Postscript SMS Marketing",
    discription:
        "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
    logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
    url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
},
{
  id: 4,
  name: "Postscript SMS Marketing",
  discription:
      "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
  logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
  url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
},
{
  id: 5,
  name: "Postscript SMS Marketing",
  discription:
      "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
  logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
  url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
},
{
  id: 6,
  name: "Postscript SMS Marketing",
  discription:
      "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
  logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
  url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
},
{
  id: 7,
  name: "Postscript SMS Marketing",
  discription:
      "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
  logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
  url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
},
];

export default function All_Apps() {
    return (
        <ul
            role="list"
            className="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 items-center"
        >
            {apps.map((app) => (
                <li
                    key={app.id}
                    className="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow-3xl"
                >
                    <div className="flex flex-1 flex-col p-8">
                        <img
                            className="mx-auto h-32 w-32 flex-shrink-0 rounded-full"
                            src={app.logo}
                            alt=""
                        />
                        <h3 className="mt-2 text-lg font-serif font-bold text-gray-900 ">
                            {app.name}
                        </h3>
                        <StarRating rating={4} />
                    </div>
                    <div>
                        <button className='btnPrimary'>check it</button>
                    </div>
                </li>
            ))}
        </ul>
    );
}

const StarRating = ({ rating }) => {
    const maxStars = 5; // You can change this value based on your rating scale
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;

    // Create an array to map through and render stars
    const stars = Array.from({ length: maxStars }, (_, index) => {
        if (index < fullStars) {
            return <span key={index}>&#9733;</span>; // Full star
        } else if (hasHalfStar && index === fullStars) {
            return <span key={index}>&#9734;&#9733;</span>; // Half star
        } else {
            return <span key={index}>&#9734;</span>; // Empty star
        }
    });

    return <div>{stars}</div>;
};
