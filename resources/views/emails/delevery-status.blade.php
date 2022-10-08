<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Email Template</title>
  <style>
    *,
    ::before,
    ::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap");

    body {
      font-family: "Poppins", sans-serif;
    }

    body,
    html {
      overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span {
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>

<body>
  <table style="
        max-width: 600px;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
      ">
    <!-- Top Bar Section -->
    <tr>
      <td style="
            padding: 20px 0;
            background: rgba(116, 194, 71, 0.15);
            border-bottom: 3px solid #74c247;
          ">
        <table style="width: 100%; border-collapse: collapse">
          <tr>
            <td style="font-size: 0; text-align: center">
              <table style="
                    max-width: 300px;
                    width: 100%;
                    border-collapse: collapse;
                    display: inline-block;
                  ">
                <tr>
                  <td style="width: 300px">
                    <a href="https://bennebosmarket.com/" target="_blank" style="
                          display: block;
                          text-align: center;
                          padding: 10px 0;
                        ">
                      <img src="{{ asset('assets/front/images/header/logo.png') }}" alt="logo bennebos"
                        style="max-width: 100%" />
                    </a>
                  </td>
                </tr>
              </table>
              <table style="
                    max-width: 300px;
                    width: 100%;
                    border-collapse: collapse;
                    display: inline-block;
                  ">
                <tr>
                  <td style="height: 70px; width: 300px">
                    <a href="#" target="_blank" style="
                          display: inline-block;
                          font-weight: 500;
                          font-size: 14px;
                          line-height: 160%;
                          color: #ffffff;
                          background: #74c247;
                          border-radius: 10px;
                          text-decoration: none;
                          padding: 10px 18px;
                        ">Order Status</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- Order Text Section -->
    <tr>
      <td style="padding: 50px 40px 0px 40px">
        <table style="width: 100%; border-collapse: collapse">
          <tr>
            <td>
              <table style="width: 100%; border-collapse: collapse">
                <tr>
                  <td>
                    <h3 style="
                          font-weight: 600;
                          font-size: 24px;
                          line-height: 160%;
                          color: #eb5e10;
                          text-align: center;
                        ">
                      {{ $delivery_status }}
                    </h3>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 16px">
                    <h4 style="
                          font-weight: 600;
                          font-size: 16px;
                          line-height: 160%;
                          color: #13192b;
                        ">
                      Hey, {{ $name }},
                    </h4>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 12px">
                    <p style="
                          font-weight: 400;
                          font-size: 14px;
                          line-height: 160%;
                          color: #424c60;
                        ">
                      Thank you for ordering from Bennebos,
                    </p>
                    <p style="
                          font-weight: 400;
                          font-size: 14px;
                          line-height: 160%;
                          color: #424c60;
                        ">
                      Your Expressionery Order <b>#{{ $code }}</b> has
                      receive and will notify you once its way. If you have
                      ordered from multiple sellers, your items will be
                      delivered in separate packages. We hope you had a great
                      shopping experience! You can check your order status
                      here.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 50px">
                    <h4 style="text-align: center">
                      <a href="#" target="_blank" style="
                            display: inline-block;
                            font-weight: 500;
                            font-size: 14px;
                            line-height: 160%;
                            color: #ffffff;
                            background: #74c247;
                            border-radius: 15px;
                            text-decoration: none;
                            padding: 15px 34px;
                          ">Track Your Order</a>
                    </h4>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 36px">
                    <p style="
                          font-weight: 400;
                          font-size: 14px;
                          line-height: 160%;
                          color: #424c60;
                        ">
                      Please note, we are unable to change your delivery
                      address once your order is placed.​
                    </p>
                    <p style="
                          font-weight: 400;
                          font-size: 14px;
                          line-height: 160%;
                          color: #424c60;
                        ">
                      Here's a confirmation of what you bought in your order.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 36px">
                    <h4 style="
                          font-weight: 600;
                          font-size: 16px;
                          line-height: 160%;
                          color: #13192b;
                          padding-bottom: 10px;
                          border-bottom: 2px solid rgba(116, 194, 71, 0.2);
                        ">
                      Delivery Details
                    </h4>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 20px">
                    <h5 style="
                          font-weight: 800;
                          font-size: 12px;
                          line-height: 160%;
                          text-transform: uppercase;
                          color: #13192b;
                        ">
                      {{ $name }}
                    </h5>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 12px">
                    <div style="max-width: 357px; width: 100%">
                      <p style="
                            font-weight: 400;
                            font-size: 12px;
                            line-height: 160%;
                            color: #424c60;
                          ">
                        {{ $order_address->address }}
                      </p>
                      <h4 style="
                            display: inline-block;
                            font-weight: 400;
                            font-size: 12px;
                            line-height: 160%;
                            color: #424c60;
                            margin-right: 5px;
                          ">
                        Phone : &nbsp;<a href="tel:+0012345678" style="
                              font-weight: 400;
                              font-size: 12px;
                              line-height: 160%;
                              color: #424c60;
                              text-decoration: none;
                            ">{{ $order_address->phone }}</a>
                      </h4>
                      <h4 style="
                            display: inline-block;
                            font-weight: 400;
                            font-size: 12px;
                            line-height: 160%;
                            color: #424c60;
                          ">
                        Email : &nbsp;<a href="mailto:abc12345@gmail.com" style="
                              font-weight: 400;
                              font-size: 12px;
                              line-height: 160%;
                              color: #424c60;
                              text-decoration: none;
                            ">{{ $order_address->email }}</a>
                      </h4>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 36px">
                    <h4 style="
                          font-weight: 600;
                          font-size: 16px;
                          line-height: 160%;
                          color: #13192b;
                          padding-bottom: 10px;
                          border-bottom: 2px solid rgba(116, 194, 71, 0.2);
                        ">
                      Order Details
                    </h4>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 24px">
                    <table style="width: 100%; border-collapse: collapse">
                      <tr>
                        <th colspan="2" style="
                              font-weight: 500;
                              font-size: 14px;
                              line-height: 160%;
                              color: #424c60;
                              padding: 15px 10px;
                              background: #eaf6e3;
                            ">
                          Product
                        </th>
                        <th style="
                              font-weight: 500;
                              font-size: 14px;
                              line-height: 160%;
                              color: #424c60;
                              padding: 15px 10px;
                              background: #eaf6e3;
                            ">
                          QTY
                        </th>
                        <th style="
                              font-weight: 500;
                              font-size: 14px;
                              line-height: 160%;
                              color: #424c60;
                              padding: 15px 10px;
                              background: #eaf6e3;
                            ">
                          Price
                        </th>
                      </tr>
                      @foreach ($mail_order_details as $item)
                      <tr>
                        <td style="padding: 12px; border: 1.5px solid #f7f7f7">
                          <div>
                            <a href="#" target="_blank" style="display: block; text-align: center">
                              <img src="{{ product($item->product_id)->thumbnail }}"
                                style="max-width: 100%; max-height: 90px" alt="product" />
                            </a>
                          </div>
                        </td>
                        <td style="padding: 12px; border: 1.5px solid #f7f7f7">
                          <h4>
                            <a href="#" target="_blank" style="
                                  display: block;
                                  font-weight: 500;
                                  font-size: 12px;
                                  line-height: 160%;
                                  color: #424c60;
                                  text-decoration: none;
                                  height: 38px;
                                  overflow: hidden;
                                  display: -webkit-box;
                                  -webkit-line-clamp: 2;
                                  -webkit-box-orient: vertical;
                                  max-width: 160px;
                                  width: 100%;
                                ">{{ product($item->product_id)->name }}
                            </a>
                          </h4>
                        </td>
                        <td style="padding: 12px; border: 1.5px solid #f7f7f7">
                          <h4 style="
                                font-weight: 500;
                                font-size: 12px;
                                line-height: 160%;
                                text-align: center;
                                color: #424c60;
                              ">
                            {{ $item->quantity }}
                          </h4>
                        </td>
                        <td style="padding: 12px; border: 1.5px solid #f7f7f7">
                          <h4 style="
                                font-weight: 500;
                                font-size: 12px;
                                line-height: 160%;
                                text-align: center;
                                color: #424c60;
                              ">
                            ₺{{ product($item->product_id)->unit_price }}
                          </h4>
                        </td>
                      </tr>
                      @endforeach


                      <tr>
                        <td colspan="3" style="padding-top: 12px">
                          <h5 style="
                                font-weight: 500;
                                font-size: 12px;
                                line-height: 160%;
                                color: #6b7280;
                                text-align: end;
                              ">
                            Subtotal :
                          </h5>
                        </td>
                        <td style="padding-top: 12px">
                          <h5 style="
                                font-weight: 600;
                                font-size: 12px;
                                line-height: 160%;
                                text-align: center;
                                color: #424c60;
                              ">
                            ₺{{ $item->total }}
                          </h5>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" style="padding-top: 6px">
                          <h5 style="
                                font-weight: 600;
                                font-size: 12px;
                                line-height: 160%;
                                text-align: end;
                                color: #13192b;
                                padding-top: 6px;
                                border-top: 1.5px solid #f7f7f7;
                              ">
                            Total :
                          </h5>
                        </td>
                        <td style="padding-top: 6px">
                          <h5 style="
                                font-weight: 600;
                                font-size: 12px;
                                line-height: 160%;
                                text-align: center;
                                color: #13192b;
                                padding-top: 6px;
                                border-top: 1.5px solid #f7f7f7;
                              ">
                            ₺{{ order($item->order_id)->grand_total }}
                          </h5>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 46px">
                    <h4 style="
                          font-weight: 600;
                          font-size: 16px;
                          line-height: 160%;
                          color: #13192b;
                        ">
                      NOTES
                    </h4>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 15px">
                    <p style="
                          font-weight: 400;
                          font-size: 12px;
                          line-height: 160%;
                          color: #424c60;
                        ">
                      For more information, visit our
                      <a href="#" target="_blank" style="color: #13192b"><b>Bennebos Help Center</b></a>
                      or check our
                      <a href="#" target="_blank" style="color: #13192b"><b>Return Policy</b></a>
                      here. Please also note that any transactions made off
                      the Bennebos platform violate our Terms of Service.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 32px; border-bottom: 3px solid #74c247"></td>
    </tr>
    <!-- Footer Section -->
    <tr>
      <td style="padding-top: 30px">
        <table style="width: 100%; border-collapse: collapse">
          <tr>
            <td style="font-size: 0; text-align: center">
              <table style="
                    max-width: 300px;
                    width: 100%;
                    border-collapse: collapse;
                    display: inline-block;
                  ">
                <tr>
                  <td style="width: 300px">
                    <a href="https://bennebosmarket.com/" target="_blank" style="
                          display: block;
                          text-align: center;
                          padding: 10px 0;
                        ">
                      <img src="{{ asset('assets/front/images/header/logo.svg') }}" alt="logo bennebos" style="max-width: 100%" />
                    </a>
                  </td>
                </tr>
              </table>
              <table style="
                    max-width: 300px;
                    width: 100%;
                    border-collapse: collapse;
                    display: inline-block;
                  ">
                <tr>
                  <td style="height: 70px; width: 300px">
                    <div>
                      <a href="https://bennebosmarket.com/" target="_blank" style="display: inline-block; margin-right: 15px">
                        <img src="{{ asset('assets/front/assets/images/icon/email_social_icon1.png') }}" alt="social icon" />
                      </a>
                      <a href="https://bennebosmarket.com/" target="_blank" style="display: inline-block; margin-right: 15px">
                        <img src="{{ asset('assets/front/assets/images/icon/email_social_icon2.png') }}" alt="social icon" />
                      </a>
                      <a href="https://bennebosmarket.com/" target="_blank" style="display: inline-block; margin-right: 15px">
                        <img src="{{ asset('assets/front/assets/images/icon/email_social_icon3.png') }}" alt="social icon" />
                      </a>
                      <a href="https://bennebosmarket.com/" target="_blank" style="display: inline-block">
                        <img src="{{ asset('assets/front/assets/images/icon/email_social_icon4.png') }}" alt="social icon" />
                      </a>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding: 45px 40px 0 40px">
        <div style="
              max-width: 297px;
              width: 100%;
              margin-left: auto;
              margin-right: auto;
              text-align: center;
            ">
          <div>
            <a href="#" target="_blank" style="
                  display: inline-block;
                  font-weight: 600;
                  font-size: 14px;
                  line-height: 160%;
                  color: #424c60;
                  margin-right: 5px;
                  text-decoration: none;
                ">HELP CENTER |
            </a>
            <a href="#" target="_blank" style="
                  display: inline-block;
                  font-weight: 600;
                  font-size: 14px;
                  line-height: 160%;
                  color: #424c60;
                  text-decoration: none;
                ">CONTACT US
            </a>
          </div>
          <p style="
                font-weight: 400;
                font-size: 12px;
                line-height: 160%;
                color: #6b7280;
                padding-top: 12px;
              ">
            Road No, 120/11 House No, 120, Hasan Nagar, Sadar, Istambul,
            Turkey, 0000
          </p>
        </div>
      </td>
    </tr>
    <tr>
      <td style="padding: 36px 40px 30px 40px">
        <p style="
              font-weight: 400;
              font-size: 12px;
              line-height: 160%;
              text-align: center;
              color: #424c60;
              max-width: 431px;
              width: 100%;
              margin-left: auto;
              margin-right: auto;
            ">
          This is an automatically generated e-mail from our subscription
          list. Please do not reply to this e-mail.
        </p>
      </td>
    </tr>
  </table>
</body>

</html>