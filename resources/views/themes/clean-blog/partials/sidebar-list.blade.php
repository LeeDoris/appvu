<div class="sidebar boxed">
    <div class="row" style="margin-top: 30px;">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="widget featured">
                <h6 class="title">Contact Us</h6>
                <div class="featured-introduce">
                    <h5>Have you created or seen something awesome related to PHP or Java? Submit it here to
                        share it with us!</h5>
                    <a href="" class="btn btn-default btn-default--transparent"
                       style="border-radius: 4px; font-size: 14px;font-weight: 400;padding: 8px 16px;">
                        Submit Yours
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </div>
            </div>
            <div class="widget category">
                <h6 class="title">Category</h6>
                <ul class="category-list slide">
                    @foreach(\App\Category::all() as $category)
                        <li>
                            <a href="{{route('web.category', $category->name)}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>