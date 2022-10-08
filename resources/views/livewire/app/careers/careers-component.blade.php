<div>
  <!-- Career Search Section  -->
  <section class="career_search_wrapper" style="background-image: url(assets/front/images/others/career_img.png)">
  </section>
  <!-- Career Serach Form Section  -->
  <section class="career_from_wrapper">
    <div class="my-container">
      <form action="" class="career_form">
        <h3>Who We Are Looking For?</h3>
        <div class="career_form_grid">
          <div class="input_area">
            <input type="text" placeholder="Search for job" />
            <img src="{{ asset('assets/front/images/icon/carrer_search.svg') }}" alt="search" class="search_icon" />
          </div>
          <button type="submit" class="career_btn">Search</button>
        </div>
      </form>
    </div>
  </section>
  <!-- Career Table Section  -->
  <section class="career_table_wrapper">
    <div class="my-container">
      <div class="career_title_area">
        <h4>Our Job Board</h4>
        <p>
          At Alibaba, you'll find diverse career paths wovenacross our
          businesses and in locations all over the world. Not every location
          has every type of job
        </p>
      </div>
      <div class="career_table_area">
        <table>
          <tr>
            <th>Job Type</th>
            <th>Position Title</th>
            <th></th>
          </tr>
          @foreach ($careers as $career)
          <tr>
            <td>
              <h4>{{ $career->type }}</h4>
            </td>
            <td>
              <h4>{{ $career->subject }}</h4>
            </td>
            <td>
              <div class="apply_btn_area">
                <a href="" class="apply_btn">Apply Now</a>
              </div>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </section>
</div>