import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { MatTableModule } from '@angular/material/table';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatSnackBar, MatSnackBarModule } from '@angular/material/snack-bar';
import { MatDialogModule } from '@angular/material/dialog';
import { MatProgressBarModule } from '@angular/material/progress-bar';
import { Feed, FeedService } from './feed.service';

@Component({
  selector: 'app-feed-list',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule,
    MatTableModule,
    MatButtonModule,
    MatIconModule,
    MatFormFieldModule,
    MatInputModule,
    MatSnackBarModule,
    MatDialogModule,
    MatProgressBarModule
  ],
  templateUrl: './feed-list.component.html',
  styleUrls: ['./feed-list.component.scss']
})
export class FeedListComponent implements OnInit {
  feeds: Feed[] = [];
  loading = false;
  addFeedDialog = { open: false, name: '', homepage: '' };

  constructor(
    private feedService: FeedService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit() {
    this.loadFeeds();
  }

  loadFeeds() {
    this.loading = true;
    this.feedService.getFeeds().subscribe({
      next: (feeds: Feed[]) => {
        this.feeds = feeds;
        this.loading = false;
      },
      error: () => {
        this.snackBar.open('Failed to load feeds', 'Close', { duration: 3000 });
        this.loading = false;
      }
    });
  }

  addFeed(feed: { name: string; homepage: string }) {
    this.feedService.addFeed(feed).subscribe({
      next: () => {
        this.snackBar.open('Feed added', 'Close', { duration: 2000 });
        this.loadFeeds();
      },
      error: () => this.snackBar.open('Failed to add feed', 'Close', { duration: 3000 })
    });
  }

  deleteFeed(id: number) {
    this.feedService.deleteFeed(id).subscribe({
      next: () => {
        this.snackBar.open('Feed deleted', 'Close', { duration: 2000 });
        this.loadFeeds();
      },
      error: () => this.snackBar.open('Failed to delete feed', 'Close', { duration: 3000 })
    });
  }

  updateFeed(id: number, data: Partial<Feed>) {
    this.feedService.updateFeed(id, data).subscribe({
      next: () => {
        this.snackBar.open('Feed updated', 'Close', { duration: 2000 });
        this.loadFeeds();
      },
      error: () => this.snackBar.open('Failed to update feed', 'Close', { duration: 3000 })
    });
  }
}
