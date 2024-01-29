@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="
          padding: 80px 0 0px 0;
          font-family: 'Noto Sans Myanmar', sans-serif;
        ">
  <!-- content section start -->
  <p class="text-center" style="font-size: 20px; color: var(--Font-Body, #5a5a5a)">
    တစ်နေ့တာထီထိုးမှတ်တမ်း
  </p>

  <div class="d-flex justify-content-around align-items-center m-2">
    <button class="bg-transparent d-block click" id="nine-thirty">
      <div class="text-center" style="
                padding: 12px 16px;
                border-radius: 5px;
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                background: var(
                  --Primary-Linear-01,
                  linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
                );
                outline: none;
                border: none;
              ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" viewBox="0 0 26 30" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9168 16.6667C19.9168 20.3486 16.9321 23.3333 13.2502 23.3333C9.56826 23.3333 6.5835 20.3486 6.5835 16.6667C6.5835 12.9848 9.56826 10 13.2502 10C15.0183 10 16.714 10.7024 17.9642 11.9526C19.2145 13.2029 19.9168 14.8986 19.9168 16.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984V5.74984ZM18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984V4.24984ZM8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984V4.24984ZM18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984V5.74984ZM9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984H9.00016ZM7.50016 6.6665C7.50016 7.08072 7.83595 7.4165 8.25016 7.4165C8.66438 7.4165 9.00016 7.08072 9.00016 6.6665H7.50016ZM7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984H7.50016ZM9.00016 1.6665C9.00016 1.25229 8.66438 0.916504 8.25016 0.916504C7.83595 0.916504 7.50016 1.25229 7.50016 1.6665H9.00016ZM19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984H19.0002ZM17.5002 6.6665C17.5002 7.08072 17.8359 7.4165 18.2502 7.4165C18.6644 7.4165 19.0002 7.08072 19.0002 6.6665H17.5002ZM17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984H17.5002ZM19.0002 1.6665C19.0002 1.25229 18.6644 0.916504 18.2502 0.916504C17.8359 0.916504 17.5002 1.25229 17.5002 1.6665H19.0002ZM13.0485 14.7615C13.0485 14.3473 12.7127 14.0115 12.2985 14.0115C11.8843 14.0115 11.5485 14.3473 11.5485 14.7615H13.0485ZM12.2985 17.6182H11.5485C11.5485 18.0324 11.8843 18.3682 12.2985 18.3682V17.6182ZM15.1552 18.3682C15.5694 18.3682 15.9052 18.0324 15.9052 17.6182C15.9052 17.204 15.5694 16.8682 15.1552 16.8682V18.3682ZM8.25016 4.24984C4.15405 4.24984 0.833496 7.57039 0.833496 11.6665H2.3335C2.3335 8.39882 4.98248 5.74984 8.25016 5.74984V4.24984ZM0.833496 11.6665V21.6665H2.3335V11.6665H0.833496ZM0.833496 21.6665C0.833496 25.7626 4.15405 29.0832 8.25016 29.0832V27.5832C4.98248 27.5832 2.3335 24.9342 2.3335 21.6665H0.833496ZM8.25016 29.0832H18.2502V27.5832H8.25016V29.0832ZM18.2502 29.0832C22.3463 29.0832 25.6668 25.7626 25.6668 21.6665H24.1668C24.1668 24.9342 21.5178 27.5832 18.2502 27.5832V29.0832ZM25.6668 21.6665V11.6665H24.1668V21.6665H25.6668ZM25.6668 11.6665C25.6668 7.57039 22.3463 4.24984 18.2502 4.24984V5.74984C21.5178 5.74984 24.1668 8.39882 24.1668 11.6665H25.6668ZM8.25016 5.74984H18.2502V4.24984H8.25016V5.74984ZM7.50016 4.99984V6.6665H9.00016V4.99984H7.50016ZM9.00016 4.99984V1.6665H7.50016V4.99984H9.00016ZM17.5002 4.99984V6.6665H19.0002V4.99984H17.5002ZM19.0002 4.99984V1.6665H17.5002V4.99984H19.0002ZM11.5485 14.7615V17.6182H13.0485V14.7615H11.5485ZM12.2985 18.3682H15.1552V16.8682H12.2985V18.3682Z" fill="white" />
        </svg>
        <p class="mt-3" style="font-size: 14px">9:30AM</p>
      </div>
    </button>
    <button class="bg-transparent d-block" id="twelve">
      <div class="text-center" style="
                padding: 12px 16px;
                border-radius: 5px;
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                background: var(
                  --Primary-Linear-01,
                  linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
                );
                outline: none;
                border: none;
              ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" viewBox="0 0 26 30" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9168 16.6667C19.9168 20.3486 16.9321 23.3333 13.2502 23.3333C9.56826 23.3333 6.5835 20.3486 6.5835 16.6667C6.5835 12.9848 9.56826 10 13.2502 10C15.0183 10 16.714 10.7024 17.9642 11.9526C19.2145 13.2029 19.9168 14.8986 19.9168 16.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984V5.74984ZM18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984V4.24984ZM8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984V4.24984ZM18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984V5.74984ZM9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984H9.00016ZM7.50016 6.6665C7.50016 7.08072 7.83595 7.4165 8.25016 7.4165C8.66438 7.4165 9.00016 7.08072 9.00016 6.6665H7.50016ZM7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984H7.50016ZM9.00016 1.6665C9.00016 1.25229 8.66438 0.916504 8.25016 0.916504C7.83595 0.916504 7.50016 1.25229 7.50016 1.6665H9.00016ZM19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984H19.0002ZM17.5002 6.6665C17.5002 7.08072 17.8359 7.4165 18.2502 7.4165C18.6644 7.4165 19.0002 7.08072 19.0002 6.6665H17.5002ZM17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984H17.5002ZM19.0002 1.6665C19.0002 1.25229 18.6644 0.916504 18.2502 0.916504C17.8359 0.916504 17.5002 1.25229 17.5002 1.6665H19.0002ZM13.0485 14.7615C13.0485 14.3473 12.7127 14.0115 12.2985 14.0115C11.8843 14.0115 11.5485 14.3473 11.5485 14.7615H13.0485ZM12.2985 17.6182H11.5485C11.5485 18.0324 11.8843 18.3682 12.2985 18.3682V17.6182ZM15.1552 18.3682C15.5694 18.3682 15.9052 18.0324 15.9052 17.6182C15.9052 17.204 15.5694 16.8682 15.1552 16.8682V18.3682ZM8.25016 4.24984C4.15405 4.24984 0.833496 7.57039 0.833496 11.6665H2.3335C2.3335 8.39882 4.98248 5.74984 8.25016 5.74984V4.24984ZM0.833496 11.6665V21.6665H2.3335V11.6665H0.833496ZM0.833496 21.6665C0.833496 25.7626 4.15405 29.0832 8.25016 29.0832V27.5832C4.98248 27.5832 2.3335 24.9342 2.3335 21.6665H0.833496ZM8.25016 29.0832H18.2502V27.5832H8.25016V29.0832ZM18.2502 29.0832C22.3463 29.0832 25.6668 25.7626 25.6668 21.6665H24.1668C24.1668 24.9342 21.5178 27.5832 18.2502 27.5832V29.0832ZM25.6668 21.6665V11.6665H24.1668V21.6665H25.6668ZM25.6668 11.6665C25.6668 7.57039 22.3463 4.24984 18.2502 4.24984V5.74984C21.5178 5.74984 24.1668 8.39882 24.1668 11.6665H25.6668ZM8.25016 5.74984H18.2502V4.24984H8.25016V5.74984ZM7.50016 4.99984V6.6665H9.00016V4.99984H7.50016ZM9.00016 4.99984V1.6665H7.50016V4.99984H9.00016ZM17.5002 4.99984V6.6665H19.0002V4.99984H17.5002ZM19.0002 4.99984V1.6665H17.5002V4.99984H19.0002ZM11.5485 14.7615V17.6182H13.0485V14.7615H11.5485ZM12.2985 18.3682H15.1552V16.8682H12.2985V18.3682Z" fill="white" />
        </svg>
        <p class="mt-3" style="font-size: 14px">12:00PM</p>
      </div>
    </button>
    <button class="bg-transparent d-block" id="two">
      <div class="text-center" style="
                padding: 12px 16px;
                border-radius: 5px;
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                background: var(
                  --Primary-Linear-01,
                  linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
                );
                outline: none;
                border: none;
              ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" viewBox="0 0 26 30" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9168 16.6667C19.9168 20.3486 16.9321 23.3333 13.2502 23.3333C9.56826 23.3333 6.5835 20.3486 6.5835 16.6667C6.5835 12.9848 9.56826 10 13.2502 10C15.0183 10 16.714 10.7024 17.9642 11.9526C19.2145 13.2029 19.9168 14.8986 19.9168 16.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984V5.74984ZM18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984V4.24984ZM8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984V4.24984ZM18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984V5.74984ZM9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984H9.00016ZM7.50016 6.6665C7.50016 7.08072 7.83595 7.4165 8.25016 7.4165C8.66438 7.4165 9.00016 7.08072 9.00016 6.6665H7.50016ZM7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984H7.50016ZM9.00016 1.6665C9.00016 1.25229 8.66438 0.916504 8.25016 0.916504C7.83595 0.916504 7.50016 1.25229 7.50016 1.6665H9.00016ZM19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984H19.0002ZM17.5002 6.6665C17.5002 7.08072 17.8359 7.4165 18.2502 7.4165C18.6644 7.4165 19.0002 7.08072 19.0002 6.6665H17.5002ZM17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984H17.5002ZM19.0002 1.6665C19.0002 1.25229 18.6644 0.916504 18.2502 0.916504C17.8359 0.916504 17.5002 1.25229 17.5002 1.6665H19.0002ZM13.0485 14.7615C13.0485 14.3473 12.7127 14.0115 12.2985 14.0115C11.8843 14.0115 11.5485 14.3473 11.5485 14.7615H13.0485ZM12.2985 17.6182H11.5485C11.5485 18.0324 11.8843 18.3682 12.2985 18.3682V17.6182ZM15.1552 18.3682C15.5694 18.3682 15.9052 18.0324 15.9052 17.6182C15.9052 17.204 15.5694 16.8682 15.1552 16.8682V18.3682ZM8.25016 4.24984C4.15405 4.24984 0.833496 7.57039 0.833496 11.6665H2.3335C2.3335 8.39882 4.98248 5.74984 8.25016 5.74984V4.24984ZM0.833496 11.6665V21.6665H2.3335V11.6665H0.833496ZM0.833496 21.6665C0.833496 25.7626 4.15405 29.0832 8.25016 29.0832V27.5832C4.98248 27.5832 2.3335 24.9342 2.3335 21.6665H0.833496ZM8.25016 29.0832H18.2502V27.5832H8.25016V29.0832ZM18.2502 29.0832C22.3463 29.0832 25.6668 25.7626 25.6668 21.6665H24.1668C24.1668 24.9342 21.5178 27.5832 18.2502 27.5832V29.0832ZM25.6668 21.6665V11.6665H24.1668V21.6665H25.6668ZM25.6668 11.6665C25.6668 7.57039 22.3463 4.24984 18.2502 4.24984V5.74984C21.5178 5.74984 24.1668 8.39882 24.1668 11.6665H25.6668ZM8.25016 5.74984H18.2502V4.24984H8.25016V5.74984ZM7.50016 4.99984V6.6665H9.00016V4.99984H7.50016ZM9.00016 4.99984V1.6665H7.50016V4.99984H9.00016ZM17.5002 4.99984V6.6665H19.0002V4.99984H17.5002ZM19.0002 4.99984V1.6665H17.5002V4.99984H19.0002ZM11.5485 14.7615V17.6182H13.0485V14.7615H11.5485ZM12.2985 18.3682H15.1552V16.8682H12.2985V18.3682Z" fill="white" />
        </svg>
        <p class="mt-3" style="font-size: 14px">02:00PM</p>
      </div>
    </button>
    <button class="bg-transparent d-block" id="four-thirty">
      <div class="text-center" style="
                padding: 12px 16px;
                border-radius: 5px;
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                background: var(
                  --Primary-Linear-01,
                  linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
                );
                outline: none;
                border: none;
              ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" viewBox="0 0 26 30" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9168 16.6667C19.9168 20.3486 16.9321 23.3333 13.2502 23.3333C9.56826 23.3333 6.5835 20.3486 6.5835 16.6667C6.5835 12.9848 9.56826 10 13.2502 10C15.0183 10 16.714 10.7024 17.9642 11.9526C19.2145 13.2029 19.9168 14.8986 19.9168 16.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984V5.74984ZM18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984V4.24984ZM8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984V4.24984ZM18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984V5.74984ZM9.00016 4.99984C9.00016 4.58562 8.66438 4.24984 8.25016 4.24984C7.83595 4.24984 7.50016 4.58562 7.50016 4.99984H9.00016ZM7.50016 6.6665C7.50016 7.08072 7.83595 7.4165 8.25016 7.4165C8.66438 7.4165 9.00016 7.08072 9.00016 6.6665H7.50016ZM7.50016 4.99984C7.50016 5.41405 7.83595 5.74984 8.25016 5.74984C8.66438 5.74984 9.00016 5.41405 9.00016 4.99984H7.50016ZM9.00016 1.6665C9.00016 1.25229 8.66438 0.916504 8.25016 0.916504C7.83595 0.916504 7.50016 1.25229 7.50016 1.6665H9.00016ZM19.0002 4.99984C19.0002 4.58562 18.6644 4.24984 18.2502 4.24984C17.8359 4.24984 17.5002 4.58562 17.5002 4.99984H19.0002ZM17.5002 6.6665C17.5002 7.08072 17.8359 7.4165 18.2502 7.4165C18.6644 7.4165 19.0002 7.08072 19.0002 6.6665H17.5002ZM17.5002 4.99984C17.5002 5.41405 17.8359 5.74984 18.2502 5.74984C18.6644 5.74984 19.0002 5.41405 19.0002 4.99984H17.5002ZM19.0002 1.6665C19.0002 1.25229 18.6644 0.916504 18.2502 0.916504C17.8359 0.916504 17.5002 1.25229 17.5002 1.6665H19.0002ZM13.0485 14.7615C13.0485 14.3473 12.7127 14.0115 12.2985 14.0115C11.8843 14.0115 11.5485 14.3473 11.5485 14.7615H13.0485ZM12.2985 17.6182H11.5485C11.5485 18.0324 11.8843 18.3682 12.2985 18.3682V17.6182ZM15.1552 18.3682C15.5694 18.3682 15.9052 18.0324 15.9052 17.6182C15.9052 17.204 15.5694 16.8682 15.1552 16.8682V18.3682ZM8.25016 4.24984C4.15405 4.24984 0.833496 7.57039 0.833496 11.6665H2.3335C2.3335 8.39882 4.98248 5.74984 8.25016 5.74984V4.24984ZM0.833496 11.6665V21.6665H2.3335V11.6665H0.833496ZM0.833496 21.6665C0.833496 25.7626 4.15405 29.0832 8.25016 29.0832V27.5832C4.98248 27.5832 2.3335 24.9342 2.3335 21.6665H0.833496ZM8.25016 29.0832H18.2502V27.5832H8.25016V29.0832ZM18.2502 29.0832C22.3463 29.0832 25.6668 25.7626 25.6668 21.6665H24.1668C24.1668 24.9342 21.5178 27.5832 18.2502 27.5832V29.0832ZM25.6668 21.6665V11.6665H24.1668V21.6665H25.6668ZM25.6668 11.6665C25.6668 7.57039 22.3463 4.24984 18.2502 4.24984V5.74984C21.5178 5.74984 24.1668 8.39882 24.1668 11.6665H25.6668ZM8.25016 5.74984H18.2502V4.24984H8.25016V5.74984ZM7.50016 4.99984V6.6665H9.00016V4.99984H7.50016ZM9.00016 4.99984V1.6665H7.50016V4.99984H9.00016ZM17.5002 4.99984V6.6665H19.0002V4.99984H17.5002ZM19.0002 4.99984V1.6665H17.5002V4.99984H19.0002ZM11.5485 14.7615V17.6182H13.0485V14.7615H11.5485ZM12.2985 18.3682H15.1552V16.8682H12.2985V18.3682Z" fill="white" />
        </svg>
        <p class="mt-3" style="font-size: 14px">04:30PM</p>
      </div>
    </button>
  </div>

  <div class="nine-thirty">
    <p class="text-center text-dark">09:30 AM 2D ထိုးမှတ်တမ်း</p>
    <div class="card mt-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div class="card-header mt-3">
        <p class="text-center text-white">
          <script>
            var d = new Date();
            document.write(d.toLocaleDateString());
          </script>
          <br />
          <script>
            var d = new Date();
            document.write(d.toLocaleTimeString());
          </script>
        </p>
      </div>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>2D</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if ($earlymorningDigits)
        @foreach ($earlymorningDigits['two_digits'] as $index => $digit)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $digit->two_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount for 09:30AM: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $earlymorningDigits['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>

  <div class="twelve d-none">
    <p class="text-center" style="color: #000">12:00 AM 2D ထိုးမှတ်တမ်း</p>
    <div class="card mt-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div class="card-header mt-3">
        <p class="text-center text-white">
          <script>
            var d = new Date();
            document.write(d.toLocaleDateString());
          </script>
          <br />
          <script>
            var d = new Date();
            document.write(d.toLocaleTimeString());
          </script>
        </p>
      </div>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>2D</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if ($morningDigits)
        @foreach ($morningDigits['two_digits'] as $index => $digit)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $digit->two_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount for 12:00PM: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $morningDigits['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>

  <div class="two d-none">
    <p class="text-center" style="color: #000">02:00 AM 2D ထိုးမှတ်တမ်း</p>
    @if(isset($earlyeveningDigit['two_digits']) && count($eveningDigits['two_digits']) == 0)
    <p class="text-center text-dark px-3 py-2 mt-3" style="background-color: #c50408">
      ညနေပိုင်း ကံစမ်းထားသော ထီဂဏန်းများ မရှိသေးပါ
      <span>
        <a href="{{ route('user.twod-play-index-9am') }}" style="color: #f5bd02; text-decoration:none">
          <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
      </span>
    </p>
    @endif
    <div class="card mt-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div class="card-header mt-3">
        <p class="text-center text-white">
          <script>
            var d = new Date();
            document.write(d.toLocaleDateString());
          </script>
          <br />
          <script>
            var d = new Date();
            document.write(d.toLocaleTimeString());
          </script>
        </p>
      </div>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>2D</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if ($earlyeveningDigit)
        @foreach ($earlyeveningDigit['two_digits'] as $index => $digit)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $digit->two_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount for 02:00PM: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $earlyeveningDigit['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>

  <div class="four-thirty d-none">
    <p class="text-center" style="color: #000">04:30 AM 2D ထိုးမှတ်တမ်း</p>
    <div class="card mt-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div class="card-header mt-3">
        <p class="text-center text-white">
          <script>
            var d = new Date();
            document.write(d.toLocaleDateString());
          </script>
          <br />
          <script>
            var d = new Date();
            document.write(d.toLocaleTimeString());
          </script>
        </p>
      </div>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>2D</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if ($eveningDigits)
        @foreach ($eveningDigits['two_digits'] as $index => $digit)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $digit->two_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount for 04:30AM: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $eveningDigits['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>

  <!-- content section end -->
</div>

@include('user_layout.footer')
@endsection

@section('script')

<script>
  $(document).ready(function() {
    $("#profile").click(function() {
      $(".profile").removeClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').addClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#nine-thirty").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").removeClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').addClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#twelve").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").removeClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').addClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#two").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").removeClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').addClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#four-thirty").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").removeClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').addClass('click');
    })
  })
</script>
@endsection