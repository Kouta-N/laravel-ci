<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));//ここでの$thisは、TestCaseクラスを継承したArticleControllerTestクラスを指します
        $response->assertStatus(200)
            ->assertViewIs('articles.index');//testIndexメソッドはarticle.index(/)にアクセスしたとき、200ステータスが返ってくることを確認している。それ以外はエラーで返す
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));
        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get(route('articles.create'));
        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }
}