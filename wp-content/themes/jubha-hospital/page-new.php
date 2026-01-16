<?php get_header() ;?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">


<div class="hero-find-doctor">
  <div class="hero-content">
    <h1>Find A Doctor</h1>
    <div class="icon">
      <a href="/home/"><i class="fa-regular fa-house"></a></i>  <p>/ Find A Doctor</p>
    </div>
  </div>
</div>

<div class="search-box1">
  <form action="" method="get">
  <input type="search" name="q" placeholder="Type The Keyword" />
</form>
 <select>
    <option>Select Your Year</option>
    <option>Year 1</option>
    <option>Year 2</option>
    <option>Year 3</option>
    <option>Year 4</option>
    <option>Year 5</option>
    <option>Year 6</option>
    <option>Year 7</option>
    <option>Year 8</option>
    <option>Year 9</option>
    <option>Year 10</option>
    <option>Year 11</option>
    <option>Year 12</option>
    <option>Year 13</option>
    <option>Year 14</option>
    <option>Year 15</option>
    <option>Year 16</option>
    <option>Year 17</option>
    <option>Year 18</option>
    <option>Year 19</option>
    <option>Year 20</option>
    <option>Year 21</option>
    <option>Year 22</option>
    <option>Year 23</option>
    <option>Year 24</option>
    <option>Year 25</option>
    <option>Year 26</option>
    <option>Year 27</option>
    <option>Year 28</option>
    <option>Year 29</option>
    <option>Year 30</option>
    <option>Year 31</option>
    <option>Year 32</option>
    <option>Year 33</option>
    <option>Year 34</option>
    <option>Year 35</option>
    <option>Year 36</option>
    <option>Year 37</option>
    <option>Year 38</option>
    <option>Year 39</option>
    <option>Year 40</option>
    <option>Year 41</option>
    <option>Year 42</option>
    <option>Year 43</option>
    <option>Year 44</option>
    <option>Year 45</option>
    <option>Year 46</option>
    <option>Year 47</option>
    <option>Year 48</option>
    <option>Year 49</option>
    <option>Year 50</option>
    <option>Year 51</option>
    <option>Year 52</option>
    <option>Year 53</option>
    <option>Year 54</option>
    <option>Year 55</option>
    <option>Year 56</option>
    <option>Year 57</option>
    <option>Year 58</option>
    <option>Year 59</option>
    <option>Year 60</option>
    <option>Year 61</option>
    <option>Year 62</option>
    <option>Year 63</option>
    <option>Year 64</option>
    <option>Year 65</option>
    <option>Year 66</option>
    <option>Year 67</option>
    <option>Year 68</option>
    <option>Year 69</option>
    <option>Year 70</option>
    <option>Year 71</option>
    <option>Year 72</option>
    <option>Year 73</option>
    <option>Year 74</option>
    <option>Year 75</option>
    <option>Year 76</option>
    <option>Year 77</option>
    <option>Year 78</option>
    <option>Year 79</option>
    <option>Year 80</option>
    <option>Year 81</option>
    <option>Year 82</option>
    <option>Year 83</option>
    <option>Year 84</option>
    <option>Year 85</option>
    <option>Year 86</option>
    <option>Year 87</option>
    <option>Year 88</option>
    <option>Year 89</option>
    <option>Year 90</option>
    <option>Year 91</option>
    <option>Year 92</option>
    <option>Year 93</option>
    <option>Year 94</option>
    <option>Year 95</option>
    <option>Year 96</option>
    <option>Year 97</option>
    <option>Year 98</option>
    <option>Year 99</option>
    <option>Year 100</option>
  </select>
  <button type="submit">Search</button>
</div>






<div class="news-listing-main-top">
  <div class="picture-top">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/ccessful Scoliosis Surgery.png" alt="Doctor">
  </div>

  <div class="text-top">
    <h3>Successful Scoliosis Surgery For 14-year-Old Girl</h3>

    <p>
      In a medical achievement we take great pride in, our surgical team at Almana Hospital in Dammam, led by spinal surgery consultant Dr. Ahmed Hamed Amin, successfully performed a complex scoliosis correction surgery for a 14-year-old girl suffering from an advanced spinal curvature exceeding 54 degrees.
    </p>

    <button class="read-more-btn" onclick="openDetail()">
      Read more <i class="fa-solid fa-arrow-right"></i>
    </button>
  </div>
</div>

<!-- ✅ DETAIL SECTION (HIDDEN INITIALLY) -->
<div class="news-detail-overlay" id="newsDetail">
  <div class="news-detail-box">
    <span class="close-btn" onclick="closeDetail()">×</span>

    <div class="news-detail-content">
      <div class="detail-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/ccessful Scoliosis Surgery.png">
      </div>

      <div class="detail-text">
        <h2>Successful Scoliosis Surgery For 14-year-Old Girl</h2>
        <p>
          In a medical achievement we take great pride in, our surgical team at Almana Hospital in Dammam, led by spinal surgery consultant Dr. Ahmed Hamed Amin, successfully performed a complex scoliosis correction surgery for a 14-year-old girl suffering from an advanced spinal curvature exceeding 54 degrees.

Despite the complexity of the case, the corrective procedure was completed in just five hours — a notably shorter duration compared to the typical 8–9 hours required for similar surgeries. The operation involved 11 vertebrae, from the fourth thoracic vertebra to the second lumbar vertebra, with 20 screws and supportive rods used to achieve the desired spinal alignment with high precision.

We are pleased to report that the patient is now recovering well and is expected to return to her normal life in the near future, God willing.
        </p>
        <p>
            This milestone highlights the advanced surgical expertise of our medical team and reflects Almana Hospital’s ongoing commitment to delivering high-quality, specialized healthcare. It also demonstrates the continued progress of the healthcare sector in the Kingdom of Saudi Arabia.
        </p>
      </div>
    </div>
  </div>
</div>
<script>
function openDetail(){
  document.getElementById("newsDetail").style.display = "flex";
}

function closeDetail(){
  document.getElementById("newsDetail").style.display = "none";
}
</script>

<?php get_footer() ;?>